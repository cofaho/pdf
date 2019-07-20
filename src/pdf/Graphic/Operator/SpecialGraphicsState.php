<?php

namespace pdf\Graphic\Operator;


use pdf\DataStructure\Matrix;
use pdf\Document\Page\PageContentsInterface;

trait SpecialGraphicsState
{
    /**
     * @return PageContentsInterface
     */
    public function saveState(): PageContentsInterface
    {
        $this->operators[] = 'q';
        return $this;
    }

    /**
     * @return PageContentsInterface
     */
    public function restoreState(): PageContentsInterface
    {
        $this->operators[] = 'Q';
        return $this;
    }

    /**
     * @param Matrix $matrix
     * @return PageContentsInterface
     */
    public function concatCurrentTransformationMatrix(Matrix $matrix): PageContentsInterface
    {
        $this->operators[] = $matrix . ' cm';
        return $this;
    }
}
