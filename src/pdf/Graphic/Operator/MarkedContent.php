<?php

namespace pdf\Graphic\Operator;


use pdf\ObjectType\NameObject;

trait MarkedContent
{
    /**
     * @param string|NameObject $tag
     * @return $this
     */
    public function markPoint($tag)
    {
        $this->data[] = $tag . ' MP';
        return $this;
    }

    /**
     * @param string|NameObject $tag
     * @param $properties
     * @return $this
     */
    public function markProperties($tag, $properties)
    {
        $this->data[] = $tag . ' ' . $properties . ' DP';
        return $this;
    }

    /**
     * @param string|NameObject $tag
     * @return $this
     */
    public function beginMarkedContent($tag)
    {
        $this->data[] = $tag . ' BMC';
        return $this;
    }

    /**
     * @param string|NameObject $tag
     * @param $properties
     * @return $this
     */
    public function beginProperties($tag, $properties)
    {
        $this->data[] = $tag . ' ' . $properties . ' BDC';
        return $this;
    }

    /**
     * @return $this
     */
    public function endMarkedContent()
    {
        $this->data[] = 'EMC';
        return $this;
    }
}
