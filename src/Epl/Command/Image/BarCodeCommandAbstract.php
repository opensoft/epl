<?php
/*
* This file is part of ProFIT
*
* Copyright (c) 2011 Farheap Solutions (http://www.farheap.com)
*
* The unauthorized use of this code outside the boundaries of
* Farheap Solutions Inc. is prohibited.
*/

namespace Epl\Command\Image;

use Epl\CommandAbstract as Command;
use Epl\ExceptionCommand;

/**
 * Use this command to print standart bar codes
 *
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
abstract class BarCodeCommandAbstract extends Command
{
    /**
     * @var string
     */
    const NAME = 'B';

    const PHRC_B = 'B';
    const PHRC_N = 'N';

    /**
     * @var int Horizontal start position (X) in dots
     */
    protected $horizontalStartPosition;

    /**
     * @var int Vertical start position (Y) in dots
     */
    protected $verticalStartPosition;

    /**
     * 0 = normal
     * 1 = 90 degrees
     * 2 = 180 degrees
     * 3 = 270 degrees
     * @var int Rotation angle
     */
    protected $rotation;

    /**
     * @var string Bar code selection
     */
    protected $barCodeSelection;

    /**
     * @var int Narrow bar with in dots
     */
    protected $narrowBarWidth;

    /**
     * @var int Wide bar width in dots
     */
    protected $wideBarWidth;

    /**
     * @var int Bar code height in dots
     */
    protected $barCodeHeight;

    /**
     * @var string Print human readale code
     */
    protected $printHumanReadable;

    /**
     * The data in this field must comply with the selected bar code's specified format.
     * The backslash (\) character designates the following character is a literal
     * and will encode into the data field
     * @var string
     */
    protected $data;

    public function __construct($horizontalStartPosition, $verticalStartPosition, $rotation, $barCodeSelection,
                                $narrowBarWidth, $wideBarWidth, $barCodeHeight, $printHumanReadable, $data, $convertRotation = true)
    {
        $this->horizontalStartPosition = (int) $horizontalStartPosition;
        $this->verticalStartPosition   = (int) $verticalStartPosition;
        if ($convertRotation) {
            $rotation = $this->rotationConvertFromDegree($rotation);
        }
        $this->rotation                = $rotation;

        if ($this->isValidBarCodeSelection($barCodeSelection)) {
            $this->barCodeSelection    = $barCodeSelection;
        }

        if ($this->isValidNarrowBarWidth($narrowBarWidth)) {
            $this->narrowBarWidth      = $narrowBarWidth;
        }

        if ($this->isValidWideBarWidth($wideBarWidth)) {
            $this->wideBarWidth        = $wideBarWidth;
        }

        $this->barCodeHeight           = (int) $barCodeHeight;
        $this->printHumanReadable      = $this->printHumanReadableCodeConvert($printHumanReadable);
        $this->data                    = $this->escapeData($data);

    }

    /**
     * @return string
     */
    protected function getName()
    {
        return self::NAME;
    }

    /**
     * @return string
     */
    public function toEplString()
    {
        $result = $this->getName() . $this->getHorizontalStartPosition() . ',' . $this->getVerticalStartPosition() . ','
                . $this->getRotation() . ',' . $this->getBarCodeSelection() . ',' . $this->getNarrowBarWidth() . ','
                . $this->getWideBarWidth() . ',' . $this->getBarCodeHeight() . ',' . $this->getPrintHumanReadable(). ','
                . '"' . $this->getData() . '"' . $this->getSuffix();
        return $result;
    }

    /**
     * 0 = normal
     * 1 = 90 degrees
     * 2 = 180 degrees
     * 3 = 270 degrees
     * @param int $degree
     * @return int
     */
    protected function rotationConvertFromDegree($degree)
    {
        switch ($degree) {
            case 90:
                return 1;
            case 180:
                return 2;
            case 270:
                return 3;
            case 0:
                return 0;
            default:
                throw ExceptionCommand::invalidDegree($degree);
        }
        
    }

    /**
     * @param bool $printHumanReadableCode
     * @return string
     */
    protected function printHumanReadableCodeConvert($printHumanReadableCode)
    {
        if ($printHumanReadableCode) {
            return self::PHRC_B;
        }
        return self::PHRC_N;
    }

    /**
     * @param string $data
     * @return string
     */
    protected function escapeData($data)
    {
        return str_replace(array('\\', '"'), array('\\\\', '\"'), $data);
    }

    /**
     * @abstract
     * @return array
     */
    abstract protected function getAvailableBarCodeSelection();

    /**
     * @abstract
     * @param $narrowBarWidth
     * @return bool
     */
    abstract protected function isValidNarrowBarWidth($narrowBarWidth);

    /**
     * @abstract
     * @param $wideBarWidth
     * @return bool
     */
    abstract protected function isValidWideBarWidth($wideBarWidth);

    /**
     * @param $barCodeSelection
     * @return bool
     * @throws \Epl\ExceptionCommand
     */
    protected function isValidBarCodeSelection($barCodeSelection)
    {
        if (!in_array($barCodeSelection, $this->getAvailableBarCodeSelection())) {
            throw ExceptionCommand::invalidBarCodeSelection($barCodeSelection);
        }
        return true;
    }

    /**
     * @return int
     */
    public function getBarCodeHeight()
    {
        return $this->barCodeHeight;
    }

    /**
     * @return string
     */
    public function getBarCodeSelection()
    {
        return $this->barCodeSelection;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getHorizontalStartPosition()
    {
        return $this->horizontalStartPosition;
    }

    /**
     * @return int
     */
    public function getNarrowBarWidth()
    {
        return $this->narrowBarWidth;
    }

    /**
     * @return string
     */
    public function getPrintHumanReadable()
    {
        return $this->printHumanReadable;
    }

    /**
     * @return int
     */
    public function getRotation()
    {
        return $this->rotation;
    }

    /**
     * @return int
     */
    public function getVerticalStartPosition()
    {
        return $this->verticalStartPosition;
    }

    /**
     * @return int
     */
    public function getWideBarWidth()
    {
        return $this->wideBarWidth;
    }
}
