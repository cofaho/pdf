<?php

namespace pdf\DataStructure;


class Matrix
{
    /**
     * @var float[][]
     */
    protected $m;
    /**
     * @var int
     */
    protected $rows;
    /**
     * @var int
     */
    protected $cols;

    /**
     * @param int $row
     * @param int $col
     * @param null|float[][] $values
     */
    public function __construct($row, $col, $values = null)
    {
        if ($row > 0 && $col > 0) {
            $this->m = [];
            $this->rows = $row;
            $this->cols = $col;

            for ($r = 0; $r < $this->rows; $r++) {
                $this->m[] = [];
                for ($c = 0; $c < $this->cols; $c++) {
                    $this->m[$r][$c] = $values[$r][$c] ?? 0;
                }
            }
        }
    }

    public function __toString()
    {
        return sprintf("%.3F %.3F %.3F %.3F %.3F %.3F",
            $this->getElem(0, 0),
            $this->getElem(0, 1),
            $this->getElem(1, 0),
            $this->getElem(1, 1),
            $this->getElem(2, 0),
            $this->getElem(2, 1)
        );
    }

    /**
     * @param $x float
     * @param $y float
     * @return $this
     */
    public function setXY($x, $y)
    {
        $this->setElem(2, 0, $x);
        $this->setElem(2, 1, $y);
        return $this;
    }


    /**
     * @param $x float
     * @param $y float
     * @return $this
     */
    public function translate($x, $y)
    {
        $t = new Matrix(3, 3, [
            [1, 0, 0],
            [0, 1, 0],
            [$x, $y, 1]
        ]);
        $this->multiply($t);
        return $this;
    }

    /**
     * @param $x float
     * @param $y float
     * @return $this
     */
    public function scale($x, $y)
    {
        $t = new Matrix(3, 3, [
            [$x, 0, 0],
            [0, $y, 0],
            [0, 0, 1]
        ]);
        $this->multiply($t);
        return $this;
    }

    /**
     * @param $angle float radians
     * @return $this
     */
    public function rotate($angle)
    {
        $sin = sin($angle);
        $cos = cos($angle);
        $t = new Matrix(3, 3, [
            [$cos, -$sin, 0],
            [$sin, $cos, 0],
            [0, 0, 1]
        ]);
        $this->multiply($t);
        return $this;
    }

    /**
     * @param float $a radians for x
     * @param float $b radians for y
     * @return $this
     */
    public function skew($a, $b)
    {
        $t = new Matrix(3, 3, [
            [1, tan($a), 0],
            [tan($b), 1, 0],
            [0, 0, 1]
        ]);
        $this->multiply($t);
        return $this;
    }


    /**
     * @return array|float[][]
     */
    public function asArray()
    {
        return $this->m;
    }

    /**
     * @param int $row
     * @param int $col
     * @param float $val
     * @return $this
     */
    public function setElem($row, $col, $val)
    {
        if ($row > -1 && $row < $this->rows && $col > -1 && $col < $this->cols) {
            $this->m[$row][$col] = $val;
        }

        return $this;
    }

    /**
     * @param int $row
     * @param int $col
     * @return float|null
     */
    public function getElem($row, $col)
    {
        if ($row < 0 || $col < 0 || $row >= $this->rows || $col >= $this->cols) {
            return null;
        }
        return $this->m[$row][$col];
    }

    /**
     * @param Matrix $matrix
     * @return Matrix|null
     */
    public function add(Matrix $matrix)
    {
        if ($this->rows == $matrix->rows && $this->cols == $matrix->cols) {
            for ($r = 0; $r < $this->rows; $r++) {
                for ($c = 0; $c < $this->cols; $c++) {
                    $this->setElem($r, $c, $this->getElem($r, $c) + $matrix->getElem($r, $c));
                }
            }
        }
        return $this;
    }

    /**
     * @param Matrix $matrix
     * @return Matrix|null
     */
    public function subtract(Matrix $matrix)
    {
        if ($this->rows === $matrix->rows && $this->cols === $matrix->cols) {
            for ($r = 0; $r < $this->rows; $r++) {
                for ($c = 0; $c < $this->cols; $c++) {
                    $this->setElem($r, $c, $this->getElem($r, $c) - $matrix->getElem($r, $c));
                }
            }
        }
        return $this;
    }

    /**
     * @param Matrix $matrix
     * @return Matrix|null
     */
    public function multiply(Matrix $matrix)
    {
        $result = [];
        if ($this->cols === $matrix->rows) {
            for ($r = 0; $r < $this->rows; $r++) {
                $result[] = [];
                for ($c = 0; $c < $this->cols; $c++) {
                    $total = 0;
                    for ($r2 = 0; $r2 < $matrix->rows; $r2++) {
                        $total += $this->getElem($r, $r2) * $matrix->getElem($r2, $c);
                    }
                    $result[$r][] = $total;
                }
            }
        }
        $this->m = $result;
        return $this;
    }

    /**
     * @param float $num
     * @return Matrix
     */
    public function scalarMultiply($num)
    {
        for  ($r = 0; $r < $this->rows; $r++) {
            for  ($c = 0; $c < $this->cols; $c++) {
                $this->setElem($r, $c, $this->getElem($r, $c) * $num);
            }
        }
        return $this;
    }
}
