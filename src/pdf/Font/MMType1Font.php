<?php

namespace pdf\Font;


class MMType1Font extends Type1Font
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Subtype = '/MMType1';
    }

    public function __set($name, $value): void
    {
        if ($name === 'BaseFont') {
            $value = str_replace(' ', '_', $value);
        }
        parent::__set($name, $value);
    }
}
