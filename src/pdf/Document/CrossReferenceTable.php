<?php

namespace pdf\Document;


use pdf\ObjectType\PdfObject;

class CrossReferenceTable implements PdfObject
{
    protected $offsetSets = [];

    protected $currentSet = 0;

    protected $currentSetN = 0;

    protected $n = 0;

    public function __construct()
    {
        $this->offsetSets[0] = [];
        $this->addOffset(0, 0, 65535, true);
    }

    public function __toString(): string
    {
        $result[] = "\nxref\n";
        foreach ($this->offsetSets as $startObjectNumber => $offsetSet) {
            $result[] = $startObjectNumber . ' ' . count($offsetSet) . "\n" . implode('', $offsetSet);
        }

        return implode('', $result);
    }

    public function addOffset($offset, $objectNumber = null, $generationNumber = 0, $isFree = false)
    {
        if ($objectNumber !== null && $objectNumber !== $this->currentSet + $this->currentSetN) {
            $this->currentSet = $objectNumber;
            $this->offsetSets[$this->currentSet] = [];
            $this->currentSetN = 0;
        }

        $this->offsetSets[$this->currentSet][] =
            str_pad($offset, 10, '0', STR_PAD_LEFT) . ' '
            . str_pad($generationNumber, 5, '0', STR_PAD_LEFT) . ' '
            . ($isFree ? 'f' : 'n') . " \n";

        ++$this->n;
        ++$this->currentSetN;
    }

    public function getNumberOfObjects()
    {
        return $this->n;
    }
}
