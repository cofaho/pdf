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
    protected $rootPages;
    /**
     * Pages Indirect Object
     * @var IndirectObject
     */
    protected $ioRootPages;
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

        $this->rootPages = new Pages();
        $this->ioRootPages = self::addIndirectObject($this->rootPages);
        $catalog->Pages = $this->ioRootPages->getReference();

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

    /**
     * @param IndirectObject|null $parent
     * @return IndirectObject
     */
    public function addPages(IndirectObject $parent = null): IndirectObject
    {
        $parent = $parent ?? $this->ioRootPages;

        $pages = new Pages();
        $pages->Parent = $parent->getReference();
        $ioPages = $this->addIndirectObject($pages);
        $this->rootPages->addKid($ioPages);

        return $ioPages;
    }

    /**
     * @param IndirectObject|null $ioPages
     * @param array|null $format
     * @param float|null $userUnit
     * @return PDF
     */
    public function addPage(IndirectObject $ioPages = null, $format = null, $userUnit = null): PDF
    {
        if ($this->ioCurrentPage) {
            $this->writeIndirectObject($this->ioCurrentPage);
        }

        $ioPages = $ioPages ?? $this->ioRootPages;
        $pages = $ioPages->getObject();

        $page = new Page();
        $page->Parent = $ioPages->getReference();
        $page->Resources = $this->ioResources->getReference();

        if ($userUnit !== null) {
            $page->UserUnit = $userUnit;
        }

        if ($format !== null) {
            $page->MediaBox = new Rectangle([0, 0, $format[0], $format[1]]);
        }

        $this->ioCurrentPage = $this->createIndirectObject($page);
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
