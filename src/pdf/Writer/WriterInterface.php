<?php

namespace pdf\Writer;


interface WriterInterface
{
    public function __construct(string $fileName);

    public function write($data): void;

    public function getOffset(): int;
}
