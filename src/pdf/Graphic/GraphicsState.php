<?php

namespace pdf\Graphic;


use pdf\ObjectType\ArrayObject;
use pdf\ObjectType\DictionaryObject;
use pdf\ObjectType\NameObject;
use pdf\ObjectType\Stream\StreamObject;

/**
 * @property-read NameObject Type
 * @property float LW Line width
 * @property int LC Line cap
 * @property int LJ Line join
 * @property int ML Miter limit
 * @property ArrayObject D Dash pattern
 * @property NameObject RI Rendering ident
 * @property bool OP Overprint for stroking
 * @property bool op Overprint for other than stroking
 * @property int OPM Overprint mode
 * @property ArrayObject Font [font size] font - indirect reference
 * @property string BG function black-generation
 * @property NameObject BG2 function black-generation
 * @property string UCR function undercolor-removal
 * @property NameObject UCR2 function undercolor-removal
 * @property ArrayObject|NameObject TR transfer function
 * @property ArrayObject|NameObject TR2 transfer function
 * @property DictionaryObject|StreamObject|NameObject HT halftone
 * @property float FL flatness tolerance
 * @property float SM smoothness tolerance
 * @property bool SA stroke adjustment
 * @property NameObject|ArrayObject BM stroke adjustment
 * @property DictionaryObject|NameObject SMask soft mask
 * @property float CA current stroking alpha constant
 * @property float ca current stroking alpha constant for nonstroking operations
 * @property bool AIS alpha source flag (“alpha is shape”)
 * @property bool TK text knockout
 */
class GraphicsState extends DictionaryObject
{
    public function __construct(?array $config = null)
    {
        parent::__construct($config);
        $this->Type = '/ExtGState';
    }
}
