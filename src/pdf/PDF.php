<?php

namespace pdf;


use Exception;
use pdf\Document\ResourceDictionary;
use pdf\DataStructure\Rectangle;
use pdf\Document\Catalog\Catalog;
use pdf\Document\CrossReferenceTable;
use pdf\Document\Page\Page;
use pdf\Document\Page\Pages;
use pdf\Document\Trailer;
use pdf\Font\Font;
use pdf\ObjectType\IndirectObject;
use pdf\ObjectType\PdfObject;
use pdf\ObjectType\Stream\StreamObject;
use pdf\Writer\WriterInterface;

class PDF
{
    /**
     * @var WriterInterface
     */
    protected $writer;
    /**
     * @var CrossReferenceTable
     */
    protected $crossReferenceTable;
    /**
     * @var Pages
     */
    protected $pages;
    /**
     * Pages Indirect Object
     * @var IndirectObject
     */
    protected $ioPages;
    /**
     * @var Trailer
     */
    protected $trailer;
    /**
     * @var IndirectObject[]
     */
    protected $objects = [];
    /**
     * @var int
     */
    protected $objectID = 0;
    /**
     * @var Page
     */
    protected $currentPage;
    /**
     * @var IndirectObject
     */
    protected $ioCurrentPage;
    /**
     * @var ResourceDictionary
     */
    protected $resources;
    /**
     * @var IndirectObject
     */
    protected $ioResources;
    /**
     * @var int
     */
    protected $fontID = 0;
    /**
     * @var array
     */
    protected $fontIndex = [];
    /**
     * @var string
     */
    protected $currentFont;

    /**
     * PDF constructor.
     * @param WriterInterface $writer
     * @throws Exception
     */
    public function __construct(WriterInterface $writer)
    {
        $this->writer = $writer;

        $writer->write("%PDF-1.7\n");
        $writer->write("%\xE2\xE3\xCF\xD3\n");

        $this->crossReferenceTable = new CrossReferenceTable();

        $catalog = new Catalog();
        $catalog->Version = '/1.7';
        $ioCatalog = self::addIndirectObject($catalog);

        $this->pages = new Pages();
        $this->ioPages = self::addIndirectObject($this->pages);
        $catalog->Pages = $this->ioPages->getReference();

        $this->resources = new ResourceDictionary();
        $this->ioResources = self::addIndirectObject($this->resources);

        $this->trailer = new Trailer([
            'Root' => $ioCatalog->getReference()
        ]);

        $this->setFont(Font::FONT_HELVETICA);
    }


    public function save(): void
    {
        if ($this->ioCurrentPage) {
            $this->writeIndirectObject($this->ioCurrentPage);
        }

        foreach ($this->objects as $object) {
            $this->writeIndirectObject($object);
        }

        $this->trailer->xrefOffset = $this->writer->getOffset() + 1;
        $this->trailer->Size = $this->crossReferenceTable->getNumberOfObjects();
        $this->writer->write((string)$this->crossReferenceTable);
        $this->writer->write((string)$this->trailer);
    }

    public function addPages(): Pages
    {
        $pages = new Pages();
        $ioPages = $this->addIndirectObject($pages);
        $this->pages->addKid($ioPages);

        return $pages;
    }

    /**
     * @param Pages|null $pages
     * @param array|null $format
     * @param int $orientation
     * @param string|null $userUnit
     * @return PDF
     */
    public function addPage(Pages $pages = null, $format = null, $orientation = 0, $userUnit = null): PDF
    {
        if ($this->ioCurrentPage) {
            $this->writeIndirectObject($this->ioCurrentPage);
        }

        $page = new Page();
        $page->Parent = $this->ioPages->getReference();
        $page->Resources = $this->ioResources->getReference();

        if ($userUnit !== null) {
            $page->UserUnit = $userUnit;
        }

        if ($format !== null) {
            $w = $format[$orientation];
            $h = $format[1 - $orientation];
            $page->MediaBox = new Rectangle([0, 0, $w, $h]);
        }

        $this->ioCurrentPage = $this->createIndirectObject($page);
        $pages = $pages ?? $this->pages;
        $pages->addKid($this->ioCurrentPage);
        $this->currentPage = $page;

        return $this;
    }

    /**
     * @param PdfObject|null $object
     * @return IndirectObject
     */
    public function addIndirectObject(PdfObject $object = null): IndirectObject
    {
        $o = $this->createIndirectObject($object);
        $this->objects[] = $o;
        return $o;
    }

    /**
     * @param PdfObject|null $object
     * @return IndirectObject
     */
    public function createIndirectObject(PdfObject $object = null): IndirectObject
    {
        $o = new IndirectObject(++$this->objectID);
        if ($object instanceof PdfObject) {
            $o->setObject($object);
        }
        return $o;
    }

    /**
     * @param PdfObject[] $objects
     * @return PDF
     */
    public function writePageObjects(array $objects): PDF
    {
        $data = [];
        foreach ($objects as $object) {
            if ($object instanceof IndirectObject) {
                $this->writeIndirectPageObject($object);
            } elseif ($object instanceof StreamObject) {
                $this->writeIndirectPageObject($this->createIndirectObject($object));
            } else {
                $data[] = (string)$object;
            }
        }
        if (!empty($data)) {
            $stream = new StreamObject();
            $stream->setData(implode("\n", $data));
            $this->writeIndirectPageObject($this->createIndirectObject($stream));
        }
        return $this;
    }

    /**
     * @param PdfObject $object
     * @return PDF
     */
    public function writePageObject(PdfObject $object): PDF
    {
        if ($object instanceof IndirectObject) {
            $this->writeIndirectPageObject($object);
        } elseif ($object instanceof StreamObject) {
            $this->writeIndirectPageObject($this->createIndirectObject($object));
        } else {
            $data = (string)$object;
            if (!empty($data)) {
                $stream = new StreamObject();
                $stream->setData($data);
                $this->writeIndirectPageObject($this->createIndirectObject($stream));
            }
        }
        return $this;
    }

    /**
     * @param IndirectObject $object
     * @return PDF
     */
    public function writeIndirectPageObject(IndirectObject $object): PDF
    {
        $this->writeIndirectObject($object);
        $this->currentPage->Contents[] = $object->getReference();
        return $this;
    }

    /**
     * @param IndirectObject $object
     * @return PDF
     */
    public function writeIndirectObject(IndirectObject $object): PDF
    {
        $this->crossReferenceTable->addOffset(
            $this->writer->getOffset(),
            $object->getObjectNumber(),
            $object->getGenerationNumber()
        );
        $this->writer->write((string)$object . "\n");
        return $this;
    }

    /**
     * @param string $fontName
     * @return PDF
     * @throws Exception
     */
    public function setFont($fontName): PDF
    {
        if (!isset($this->fontIndex[$fontName])) {

            if (!Font::hasFont($fontName)) {
                Font::addFont($fontName);
            }

            $font = $this->createIndirectObject(Font::getFont($fontName));
            $this->writeIndirectObject($font);
            $fontID = $this->resources->addFont($font);

            $this->fontIndex[$fontName] = $fontID;
        }

        $this->currentFont = $this->fontIndex[$fontName];

        return $this;
    }

}
