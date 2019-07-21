<?php

namespace pdf\Graphic\Operator\Path;


use pdf\Document\Page\PageDescriptionInterface;

interface PathPaintingInterface
{
    public function stroke(): PageDescriptionInterface;

    public function closeAndStroke(): PageDescriptionInterface;

    public function fill($useEvenOddRule = false): PageDescriptionInterface;

    public function fillAndStroke($useEvenOddRule = false): PageDescriptionInterface;

    public function closeFillAndStroke($useEvenOddRule = false): PageDescriptionInterface;

    public function endPath(): PageDescriptionInterface;
}
