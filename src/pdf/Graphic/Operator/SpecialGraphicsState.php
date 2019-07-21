<?php

namespace pdf\Graphic\Operator;


use pdf\DataStructure\Matrix;
use pdf\Document\Page\PageDescriptionInterface;

trait SpecialGraphicsState
{
    /**
     * @return PageDescriptionInterface
     */
    public function saveState(): PageDescriptionInterface
    {
        $this->data[] = 'q';
        return $this;
    }

    /**
     * @return PageDescriptionInterface
     */
    public function restoreState(): PageDescriptionInterface
    {
        $this->data[] = 'Q';
        return $this;
    }

    /**
     * @param Matrix $matrix
     * @return PageDescriptionInterface
     */
    public function concatCurrentTransformationMatrix(Matrix $matrix): PageDescriptionInterface
    {
        $this->data[] = $matrix . ' cm';
        return $this;
    }
}
