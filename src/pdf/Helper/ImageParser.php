<?php

namespace pdf\Helper;


use Kaitai\Struct\Stream;
use pdf\Graphic\XObject\Image;
use pdf\Helper\ImageParser\Png;
use pdf\ObjectType\DictionaryObject;

class ImageParser
{
    /**
     * @var false|string
     */
    protected $file;
    /**
     * @var array|bool
     */
    protected $info;
    /**
     * @var Image
     */
    protected $image;

    /**
     * @param string $src
     */
    public function __construct(string $src)
    {
        $this->file = file_get_contents($src);
        $this->info = getimagesizefromstring($this->file);

        $this->image = new Image();
        $imgHeader = $this->image->getHeader();

        $imgHeader->Width = $this->info[0];
        $imgHeader->Height = $this->info[1];
        if ($this->info['bits']) {
            $imgHeader->BitsPerComponent = $this->info['bits'];
        }

        switch ($this->info[2]) {
            case IMAGETYPE_JPEG:
                $this->parseJPEG();
                break;
            case IMAGETYPE_PNG:
                $this->parsePNG();
                break;
        }
    }

    /**
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->image;
    }

    protected function parseJPEG()
    {
        $channels = $this->info['channels'] ?? 3;
        $imgHeader = $this->image->getHeader();

        switch ($channels) {
            case 1: {
                $imgHeader->ColorSpace = '/DeviceGray';
                break;
            }
            case 4: {
                $imgHeader->ColorSpace = '/DeviceCMYK';
                break;
            }
            default: {
                $imgHeader->ColorSpace = '/DeviceRGB';
                break;
            }
        }
        $this->image->setData($this->file);
        $imgHeader->Filter = '/DCTDecode';
        $this->image->setApplyFilters(false);
    }

    protected function parsePNG()
    {
        $parsedImg = new Png(new Stream($this->file));
        $imgHeader = $this->image->getHeader();
        $data = [];
        $icc = null;
        /** @var Png\Chunk $chunk */
        foreach ($parsedImg->chunks() as $chunk) {
            switch ($chunk->type()) {
                case 'IDAT':
                    $data[] = $chunk->body();
                    break;
            }
        }
        $data = implode($data);
        $this->image->setData($data);

        /** @var Png\IhdrChunk $ihdr */
        $ihdr = $parsedImg->ihdr();
        $colors = 1;
        switch ($ihdr->colorType()) {
            case Png\ColorType::GREYSCALE_ALPHA:
                //TODO: create soft mask
            case Png\ColorType::GREYSCALE:
                $imgHeader->ColorSpace = '/DeviceGray';
                break;
            case Png\ColorType::TRUECOLOR_ALPHA:
                //TODO: create soft mask
            case Png\ColorType::TRUECOLOR:
                $imgHeader->ColorSpace = '/DeviceRGB';
                $colors = 3;
                break;
            case Png\ColorType::INDEXED:
                $imgHeader->ColorSpace = '/Indexed';
                break;
            default:
                break;
        }

        $imgHeader->Filter = '/FlateDecode';
        $this->image->setApplyFilters(false);
        $imgHeader->BitsPerComponent = $ihdr->bitDepth();

        $imgHeader->DecodeParms = new DictionaryObject([
            'Predictor' => 15,
            'Colors' => $colors,
            'BitsPerComponent' => $imgHeader->BitsPerComponent,
            'Columns' => $ihdr->width()
        ]);

    }
}