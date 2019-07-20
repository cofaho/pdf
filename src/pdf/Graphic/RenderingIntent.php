<?php

namespace pdf\Graphic;


abstract class RenderingIntent
{
    const ABSOLUTE_COLORIMETRIC = '/AbsoluteColorimetric';

    const RELATIVE_COLORIMETRIC = '/RelativeColorimetric';

    const SATURATION = '/Saturation';

    const PERCEPTUAL = '/Perceptual';
}
