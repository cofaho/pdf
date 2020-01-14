<?php

namespace pdf\DataStructure\Tree;


use pdf\ObjectType\ArrayObject;

interface LimitsInterface
{
    public function getLimits(): ArrayObject;
}