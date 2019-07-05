<?php

namespace pdf\DataStructure;


use pdf\ObjectType\PdfObject;

class DateObject implements PdfObject
{

    public function __toString(): string
    {
        return 'D:' . str_replace(':', "'", date('YmdHisP')); // TODO: add timestamp
    }
}
