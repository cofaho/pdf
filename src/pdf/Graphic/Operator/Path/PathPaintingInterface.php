<?php

namespace pdf\Graphic\Operator\Path;


use pdf\Document\Page\PageContentsInterface;

interface PathPaintingInterface
{
    public function stroke(): PageContentsInterface;

    public function closeAndStroke(): PageContentsInterface;

    public function fill($useEvenOddRule = false): PageContentsInterface;

    public function fillAndStroke($useEvenOddRule = false): PageContentsInterface;

    public function closeFillAndStroke($useEvenOddRule = false): PageContentsInterface;

    public function endPath(): PageContentsInterface;
}
