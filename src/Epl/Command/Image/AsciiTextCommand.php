<?php

namespace Epl\Command\Image;

use Epl\CommandAbstract as Command;
use Epl\ExceptionCommand;

/**
 * Renders an ASCII text string to the image print buffer.
 *
 * @todo Command only supports text output
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class AsciiTextCommand extends Command
{
    /**
     * @var string
     */
    const NAME = 'A';

    const REVERSE_IMAGE_CONVERT_Y = 'R';
    const REVERSE_IMAGE_CONVERT_N = 'N';

    /**
     * @var int Horizontal start position (X) in dots.
     */
    private $horizontalStartPosition;

    /**
     * @var int Vertical start position (Y) in dots
     */
    private $verticalStartPosition;

    /**
     * Characters are organized vertically from left to right and then rotated to print.
     * Accepted values:
     * 0 = normal
     * 1 = 90 degrees
     * 2 = 180 degrees
     * 3 = 270 degrees
     *
     * Rotation for Asian Printers Only
     * Characters are organized horizontally from top to bottom and then rotated to print.
     * Asian printers support both horizontal and vertical character rotation.
     * Accepted values:
     * 4 = normal
     * 5 = 90 degrees
     * 6 = 180 degrees
     * 7 = 270 degrees
     * @var int
     */
    private $rotation;

    /**
     * @todo The code needs to be refined according to the documentation EPL2
     * Value  ||            203 dpi              ||           300 dpi
     * 1      || 20.3 cpi, 6 pts, (8x12 dots)    || 25cpi, 4pts, (12x20dots)
     * 2      || 16.9 cpi, 7 pts, (10x16 dots)   || 18.75 cpi, 6 pts, (16x28 dots)
     * 3      || 14.5 cpi, 12 pts (12x20 dots)   || 15 cpi, 8 pts, (20x36 dots)
     * 4      || 12.7 cpi, 12 pts, (14x24 dots)  || 12.5 cpi, 10 pts, (24x44 dots)
     * 5      || 5.6 cpi, 24 pts, (32x48 dots)   || 6.25 cpi, 21 pts, (48x80 dots)
     * A-Z    || Reserved for Soft Font Storage.
     * a-z    || Reserved for printer driver support for storage of user-selected Soft Fonts.
     * 6      || Numeric only (14x19 dots)       || Numeric only (14x19 dots)
     * 7      || Numeric only (14x19 dots)       || Numeric only (14x19 dots)
     *                           Asian Printers
     * 8      || Simplified Chinese, Japanese, Korean
     *        || 203 dpi fonts: 24x24 dots
     *        || 300 dpi Double-byte fonts: 36x36 dots
     *        || 300 dpi Single-byte fonts: 24x26 dots
     * 9      || Traditional Chinese, Japanese
     *        || 300 dpi Double-byte fonts: 36x36 dots
     *        || 300 dpi Single-byte fonts: 24x36 dots
     *        || Korean  - Reserved
     *
     * Fonts 1-5 are fixed pitch
     * Asian language option printers support a single language with fonts 8 and 9.
     * @var int
     */
    private $fontSelection;

    /**
     * Horizontal multiplier expands the text horizontally
     * Accepted values 1-6, 8
     * @var int
     */
    private $horizontalMultiplier;

    /**
     * Vertical multiplier expands the text vertically
     * Accepted Values 1-9
     * @var int
     */
    private $verticalMultiplier;

    /**
     * Reverse Image
     * Accepted values:
     * N = normal
     * R = reverse image
     * @var string
     */
    private $reverseImage;

    /**
     * Fixed data field
     * The backslash (\) character designates the following character is a literal
     * and will encode into the data field
     * @var string
     */
    private $data;

    public function __construct($horizontalStartPosition, $verticalStartPosition, $rotation, $fontSelection,
                                $horizontalMultiplier, $verticalMultiplier, $reverseImage, $data, $convertRotation = true,
                                $asianFont = false)
    {
        $this->horizontalStartPosition = (int) $horizontalStartPosition;
        $this->verticalStartPosition   = (int) $verticalStartPosition;
        if ($convertRotation) {
            $rotation = $this->rotationConvertFromDegree($rotation, $asianFont);
        }
        $this->rotation                = $rotation;
        //@todo The code needs to be refined according to the documentation EPL2
        if ($this->isValidIntegerInterval('Font selection', $fontSelection, 1, 9)) {
            $this->fontSelection       = $fontSelection;
        }

        if ($horizontalMultiplier === 8 || $this->isValidIntegerInterval('Horizontal multiplier', $horizontalMultiplier, 1, 6)) {
            $this->horizontalMultiplier = $horizontalMultiplier;
        }

        if ($this->isValidIntegerInterval('Vertical multiplier', $verticalMultiplier, 1, 9)) {
            $this->verticalMultiplier = $verticalMultiplier;
        }

        $this->reverseImage = $this->reverseImageConvert($reverseImage);
        $this->data = $this->escapeData($data);
    }

    /**
     * 0 = normal
     * 1 = 90 degrees
     * 2 = 180 degrees
     * 3 = 270 degrees
     * @param int $degree
     * @return int
     */
    private function rotationConvertFromDegree($degree, $asianFont)
    {
        switch ($degree) {
            case 90:
                if ($asianFont) {
                    return 5;
                }
                return 1;
            case 180:
                if ($asianFont) {
                    return 6;
                }
                return 2;
            case 270:
                if ($asianFont) {
                    return 7;
                }
                return 3;
            case 0:
                if ($asianFont) {
                    return 4;
                }
                return 0;
            default:
                throw ExceptionCommand::invalidDegree($degree);
        }

    }

    private function reverseImageConvert($reverseImage)
    {
        if ($reverseImage) {
            return self::REVERSE_IMAGE_CONVERT_Y;
        }
        return self::REVERSE_IMAGE_CONVERT_N;
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
                . $this->getRotation() . ',' . $this->getFontSelection() . ',' . $this->getHorizontalMultiplier() . ','
                . $this->getVerticalMultiplier() . ',' . $this->getReverseImage() . ',"' . $this->getData() . '"' . $this->getSuffix();
        return $result;
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
    public function getFontSelection()
    {
        return $this->fontSelection;
    }

    /**
     * @return int
     */
    public function getHorizontalMultiplier()
    {
        return $this->horizontalMultiplier;
    }

    /**
     * @return int
     */
    public function getHorizontalStartPosition()
    {
        return $this->horizontalStartPosition;
    }

    /**
     * @return string
     */
    public function getReverseImage()
    {
        return $this->reverseImage;
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
    public function getVerticalMultiplier()
    {
        return $this->verticalMultiplier;
    }

    /**
     * @return int
     */
    public function getVerticalStartPosition()
    {
        return $this->verticalStartPosition;
    }
}
