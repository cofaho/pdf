<?php

namespace pdf\ObjectType\Stream\Filter;


abstract class AbstractFilter
{
    abstract public static function encode($data, $params = null);
    abstract public static function decode($data, $params = null);
}
