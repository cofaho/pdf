<?php

namespace pdf\ObjectType\Stream\Filter;


abstract class Filter
{
    const ASCII_HEX_DECODE = 'ASCIIHexDecode';

    const ASCII_85_DECODE = 'ASCII85Decode';

    const LZW_DECODE = 'LZWDecode';

    const FLATE_DECODE = 'FlateDecode';

    const RUN_LENGTH_DECODE = 'RunLengthDecode';

    const CCITT_FAX_DECODE = 'CCITTFaxDecode';

    const JBIG2_DECODE = 'JBIG2Decode';

    const DCT_DECODE = 'DCTDecode';

    const JPX_DECODE = 'JPXDecode';

    const CRYPT = 'Crypt';

    /**
     * @param string $filterName
     * @param $data
     * @param null $params
     * @return string
     */
    public static function encode($filterName, $data, $params = null){
        switch ($filterName) {
            case self::ASCII_HEX_DECODE:
                return ASCIIHex::encode($data);
            case self::FLATE_DECODE:
                return Flate::encode($data);
        }
        return $data;
    }
}
