<?php

namespace pdf\ObjectType\Stream\Filter;


class Flate extends AbstractFilter
{

    public static function encode($data, $params = null)
    {
        return gzuncompress($data);
    }

    public static function decode($data, $params = null)
    {
        return gzcompress($data);
    }
}
