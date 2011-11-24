<?php

namespace Epl\Command\Image;

use Epl\CommandAbstract as Command;

/**
 *
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
abstract class LineDrawCommandAbstract extends Command
{
    /**
     * @var int Horizontal start position (X) in dots.
     */
    protected $horizontalStartPosition;

    /**
     * @var int Vertical start position (Y) in dots.
     */
    protected $verticalStartPosition;

    /**
     * @var int Horizontal length in dots
     */
    protected $horizontalLength;

    /**
     * @var int Vertical length in dots
     */
    protected $verticalLength;

    /**
     * @param int $horizontalStartPosition
     * @param int $verticalStartPosition
     * @param int $horizontalLength
     * @param int $verticalLength
     */
    public function __construct($horizontalStartPosition, $verticalStartPosition, $horizontalLength, $verticalLength)
    {
        $this->horizontalStartPosition = (int) $horizontalStartPosition;
        $this->verticalStartPosition   = (int) $verticalStartPosition;
        $this->horizontalLength        = (int) $horizontalLength;
        $this->verticalLength          = (int) $verticalLength;
    }

    /**
     * @return string
     */
    public function toEplString()
    {
        $result = $this->getName() . $this->getHorizontalStartPosition() . ',' . $this->getVerticalStartPosition() . ','
                . $this->getHorizontalLength() . ',' . $this->getVerticalLength() . $this->getSuffix();
        return $result;
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
    public function getHorizontalLength()
    {
        return $this->horizontalLength;
    }

    /**
     * @return int
     */
    public function getVerticalLength()
    {
        return $this->verticalLength;
    }

    /**
     * @return int
     */
    public function getVerticalStartPosition()
    {
        return $this->verticalStartPosition;
    }
}
