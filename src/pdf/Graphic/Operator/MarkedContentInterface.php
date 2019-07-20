<?php

namespace pdf\Graphic\Operator;

use pdf\ObjectType\NameObject;

interface MarkedContentInterface
{
    /**
     * @param string|NameObject $tag
     * @return $this
     */
    public function markPoint($tag);

    /**
     * @param string|NameObject $tag
     * @param $properties
     * @return $this
     */
    public function markProperties($tag, $properties);

    /**
     * @param string|NameObject $tag
     * @return $this
     */
    public function beginMarkedContent($tag);

    /**
     * @param string|NameObject $tag
     * @param $properties
     * @return $this
     */
    public function beginProperties($tag, $properties);

    /**
     * @return $this
     */
    public function endMarkedContent();
}
