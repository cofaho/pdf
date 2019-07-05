<?php

namespace pdf\ObjectType\Stream\Filter;


class ASCIIHex extends AbstractFilter
{
    /**
     * @param $data
     * @param null $params
     * @return string
     */
    public static function encode($data, $params = null)
    {
        return bin2hex($data) . '>';
    }

    /**
     * @param $data
     * @param null $params
     * @return bool|string
     */
    public static function decode($data, $params = null)
    {
        $data = rtrim($data, '>');
        if (mb_strlen($data, '8bit') % 2 === 1) {
            $data .= '0';
        }
        return hex2bin($data);
    }
}
