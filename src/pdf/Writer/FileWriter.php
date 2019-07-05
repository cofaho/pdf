<?php

namespace pdf\Writer;


use Exception;

class FileWriter implements WriterInterface
{
    /**
     * @var bool|resource
     */
    protected $handle;
    /**
     * @var string
     */
    protected $fileName;
    /**
     * @var int
     */
    protected $bytes = 0;

    /**
     * FileWriter constructor.
     * @param $fileName
     * @throws Exception
     */
    public function __construct($fileName)
    {
        $this->fileName = $fileName;
        $this->handle = fopen($fileName, 'w+');
        if ($this->handle === false) {
            throw new Exception("Unable to open file `{$this->fileName}`");
        }
    }

    public function __destruct()
    {
        fclose($this->handle);
    }

    /**
     * @param $data
     * @throws Exception
     */
    public function write($data): void
    {
        $bytes = fwrite($this->handle, $data);
        if ($bytes === false) {
            throw new Exception("Unable write to file `{$this->fileName}`");
        }
        $this->bytes += $bytes;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->bytes;
    }
}
