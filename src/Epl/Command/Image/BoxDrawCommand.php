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

/**
 * Use this command to draw a box shape.
 *
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class BoxDrawCommand extends Command
{
    /**
     * @var string
     */
    const NAME = 'X';

    /**
     * @var int Horizontal start position (X) in dots
     */
    private $horizontalStartPosition;

    /**
     * @var int Vertical start position (Y) in dots
     */
    private $verticalStartPosition;

    /**
     * @var int Line thickness in dots
     */
    private $lineThickness;

    /**
     * @var int Horizontal end position (X) in dots
     */
    private $horizontalEndPosition;

    /**
     * @var int Vertical end position (Y) in dots
     */
    private $verticalEndPosition;

    public function __construct($horizontalStartPosition, $verticalStartPosition, $lineThickness,
                                $horizontalEndPosition, $verticalEndPosition)
    {
        $this->horizontalStartPosition = (int) $horizontalStartPosition;
        $this->verticalStartPosition   = (int) $verticalStartPosition;
        $this->lineThickness           = (int) $lineThickness;
        $this->horizontalEndPosition   = (int) $horizontalEndPosition;
        $this->verticalEndPosition     = (int) $verticalEndPosition;
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
                . $this->getLineThickness() . ',' . $this->getHorizontalEndPosition() . ',' . $this->getVerticalEndPosition()
                . $this->getSuffix();
        return $result;
    }

    /**
     * @return int
     */
    public function getHorizontalEndPosition()
    {
        return $this->horizontalEndPosition;
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
    public function getLineThickness()
    {
        return $this->lineThickness;
    }

    /**
     * @return int
     */
    public function getVerticalEndPosition()
    {
        return $this->verticalEndPosition;
    }

    /**
     * @return int
     */
    public function getVerticalStartPosition()
    {
        return $this->verticalStartPosition;
    }
}
