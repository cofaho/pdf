<?php

namespace pdf\DataStructure\NameTree;


use pdf\ObjectType\ArrayObject;

interface LimitsInterface
{
    public function getLimits(): ArrayObject;
}