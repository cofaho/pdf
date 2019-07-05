<?php

namespace pdf\Writer;


class EchoWriter implements WriterInterface
{

    protected $bytes = 0;

    public function __construct($fileName)
    {
        header('Content-Type: application/pdf');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Expires: Mon, 1 Jan 1990 00:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Content-Disposition: inline; filename="' . basename($fileName) . '"');
    }

    public function write($data): void
    {
        $this->bytes += mb_strlen($data, '8bit');
        echo $data;
    }

    public function getOffset(): int
    {
        return $this->bytes;
    }
}
