<?php
 
namespace Epl\Command\Image;

use Epl\CommandAbstract;
use Epl\ExceptionCommand;

/**
 * Loads binary graphic data directly into the Image Buffer memory for immediate printing.
 * See more:
 *      https://support.zebra.com/cpws/docs/eltron/epl2/GW_Command.pdf
 *      https://support.zebra.com/cpws/docs/eltron/gw_command.htm
 * 
 * @author Valeriy Fomin <valeriy.fomin@opensoftdev.ru>
 */
class GraphicWriteCommand extends CommandAbstract
{
    /**
     * @var string
     */
    private $name = 'GW';

    /**
     * Horizontal start position (X) in dots.
     * 
     * @var integer
     */
    private $horizontalStartPosition;

    /**
     * Vertical start position (Y) in dots.
     *
     * @var integer
     */
    private $verticalStartPosition;

    /**
     * Width of graphic in bytes. Eight (8) dots = one (1) byte of data.
     *
     * @var integer
     */
    private $width;

    /**
     * Length of graphic in dots (or print lines).
     *
     * @var integer
     */
    private $height;

    /**
     * Raw binary data without graphic file formatting.
     * If data is taken from "BMP" image then width must be a multiple of 32(bit).
     *
     * @var string
     */
    private $data;

    /**
     * @param integer $horizontalStartPosition
     * @param integer $verticalStartPosition
     * @param integer $width
     * @param integer $height
     * @param string $data
     *
     * @throws ExceptionCommand
     */
    public function __construct(
        $horizontalStartPosition,
        $verticalStartPosition,
        $width,
        $height,
        $data
    ) {
        $this->setHorizontalStartPosition(abs((int)(int)$horizontalStartPosition));
        $this->setVerticalStartPosition(abs((int)(int)$verticalStartPosition));
        $this->setWidth(abs((int)$width));
        $this->setHeight(abs((int)(int)$height));
        $this->setData((string)$data);

        $this->isValidData($this->getData(), $this->getWidth(), $this->getHeight());
    }

    /**
     * @return string
     */
    public function toEplString()
    {
        $result = $this->getName() . $this->getHorizontalStartPosition() . ',' . $this->getVerticalStartPosition() . ','
            . $this->getWidth() . ',' . $this->getHeight() . ',' . $this->getData() . $this->getSuffix();

        return $result;
    }

    /**
     * @return integer
     */
    public function getHorizontalStartPosition()
    {
        return $this->horizontalStartPosition;
    }

    /**
     * @param integer $horizontalStartPosition
     *
     * @return GraphicWriteCommand
     */
    public function setHorizontalStartPosition($horizontalStartPosition)
    {
        $this->horizontalStartPosition = $horizontalStartPosition;

        return $this;
    }

    /**
     * @return integer
     */
    public function getVerticalStartPosition()
    {
        return $this->verticalStartPosition;
    }

    /**
     * @param integer $verticalStartPosition
     *
     * @return GraphicWriteCommand
     */
    public function setVerticalStartPosition($verticalStartPosition)
    {
        $this->verticalStartPosition = $verticalStartPosition;

        return $this;
    }

    /**
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param integer $width
     *
     * @return GraphicWriteCommand
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param integer $height
     *
     * @return GraphicWriteCommand
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $data
     *
     * @return GraphicWriteCommand
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return string
     */
    protected function getName()
    {
        return $this->name;
    }

    /**
     * @param string $data
     * @param integer $width in bytes or (pixels/8)
     * @param integer $height in bits or pixels
     *
     * @throws ExceptionCommand
     */
    private function isValidData($data, $width, $height)
    {
        // Actual data size in bytes
        $actualDataSize = (strlen($data)) / 8;

        // Calculated data size in bytes
        $calculatedDataSize = $width * ($height / 8);

        if ($actualDataSize !== $calculatedDataSize) {
            throw ExceptionCommand::invalidDataSize($actualDataSize, $calculatedDataSize);
        }
    }
}