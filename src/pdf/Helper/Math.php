<?php

namespace pdf\Helper;


class Math
{
    public static function floatToStr($float, $maxDecimals = 8)
    {
        return rtrim(rtrim(number_format($float, $maxDecimals, '.', ''), '0'), '.');
    }
}
