<?php

namespace pdf\Helper;


use pdf\Graphic\XObject\Image;

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

}