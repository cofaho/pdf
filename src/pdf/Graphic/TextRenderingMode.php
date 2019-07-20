<?php

namespace pdf\Graphic;


abstract class TextRenderingMode
{
    const FILL = 0;

    const STROKE = 1;

    const FILL_STROKE = 2;

    const INVISIBLE = 3;

    const FILL_CLIP = 4;

    const STROKE_CLIP = 5;

    const FILL_STROKE_CLIP = 6;

    const CLIP = 7;
}
