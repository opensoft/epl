<?php

namespace Epl\Command\Image;

use Epl\Command\Image\BarCode2DCommandAbstract as Command;
use Epl\ExceptionCommand;

/**
 * Use this command to print standard 2D data matrix bar codes
 * @author Maria Plyasunova <maria.plyasunova@opensoftdev.ru>
 */
class DataMatrixBarCodeCommand extends Command
{
    /**
     * @var array
     */
    protected $availableBarCodeSelection = array('D');

    /**
     * @var integer
     */
    private $minSquareSize;

    /**
     * @var integer
     */
    private $columnsToEncode;

    /**
     * @var integer
     */
    private $rowsToEncode;

    /**
     * @var string
     */
    private $inverseImage;

    /**
     * @param integer $horizontalStartPosition
     * @param integer $verticalStartPosition
     * @param string $data
     * @param string $barCodeSelection
     * @param integer $minSquareSize
     * @param integer|null $columnsToEncode
     * @param integer|null $rowsToEncode
     * @param integer|null $inverseImage
     */
    public function __construct($horizontalStartPosition, $verticalStartPosition, $data, $barCodeSelection = 'D',
                                $minSquareSize = 5, $columnsToEncode = null, $rowsToEncode = null, $inverseImage = null)
    {
        $this->horizontalStartPosition = (int) $horizontalStartPosition;
        $this->verticalStartPosition = (int) $verticalStartPosition;

        if ($this->isValidBarCodeSelection($barCodeSelection)) {
            $this->barCodeSelection = (string) $barCodeSelection;
        }

        $this->data = $this->escapeData($data);

        $this->minSquareSize = $minSquareSize;
        $this->columnsToEncode = $columnsToEncode;
        $this->rowsToEncode = $rowsToEncode;
        $this->inverseImage = $inverseImage;
    }

    /**
     * @return string
     */
    public function toEplString()
    {
        $result = $this->getName() . $this->getHorizontalStartPosition() . ',' . $this->getVerticalStartPosition() . ','
            . $this->getBarCodeSelection();

        if ($this->getColumnsToEncode()) {
            $result .= ',' . $this->getColumnsToEncode();
        }

        if ($this->getRowsToEncode()) {
            $result .= ',' . $this->getRowsToEncode();
        }

        if ($this->getMinSquareSize()) {
            $result .= ',' . $this->getMinSquareSize();
        }

        if ($this->getInverseImage()) {
            $result .= ',' . $this->getInverseImage();
        }

        $result .= ',' . '"' . $this->getData() . '"' . $this->getSuffix();

        return $result;
    }

    /**
     * @return array
     */
    protected function getAvailableBarCodeSelection()
    {
        return $this->availableBarCodeSelection;
    }

    /**
     * @return string
     */
    private function getColumnsToEncode()
    {
        if ($this->columnsToEncode !== null) {
            return 'c' . $this->columnsToEncode;
        }

        return null;
    }

    /**
     * @return string
     */
    private function getInverseImage()
    {
        if ($this->inverseImage !== null) {
            return 'v' . $this->inverseImage;
        }

        return null;
    }

    /**
     * @return string
     */
    private function getMinSquareSize()
    {
        if ($this->minSquareSize !== null) {
            return 'h' . $this->minSquareSize;
        }

        return null;
    }

    /**
     * @return string
     */
    private function getRowsToEncode()
    {
        if ($this->rowsToEncode !== null) {
            return 'r' . $this->rowsToEncode;
        }

        return null;
    }
}
