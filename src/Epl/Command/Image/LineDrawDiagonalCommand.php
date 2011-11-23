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

use Epl\Command\Image\LineDrawCommandAbstract as Command;
use Epl\ExceptionCommand;

/**
 * Use this command to draw diagonal black lines, overwriting previous information.
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class LineDrawDiagonalCommand extends Command
{
    const NAME = 'LS';

    /**
     * @var int Vertical end position (Y) in dots.
     */
    protected $verticalEndPosition;

    /**
     * @param int $horizontalStartPosition
     * @param int $verticalStartPosition
     * @param int $horizontalLength
     * @param int $verticalLength
     * @param int $verticalEndPosition
     */
    public function __construct($horizontalStartPosition, $verticalStartPosition, $horizontalLength, $verticalLength, $verticalEndPosition)
    {
        parent::__construct($horizontalStartPosition, $verticalStartPosition, $horizontalLength, $verticalLength);
        $this->verticalEndPosition = (int) $verticalEndPosition;
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
                . $this->getHorizontalLength() . ',' . $this->getVerticalLength() . ',' . $this->getVerticalEndPosition()
                . $this->getSuffix();
        return $result;
    }

    /**
     * @return int
     */
    public function getVerticalEndPosition()
    {
        return $this->verticalEndPosition;
    }
}
