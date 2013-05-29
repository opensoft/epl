<?php

namespace Epl;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class CommandHelper implements CommandHelperInterface
{
    /**
     * @var \Epl\CommandCompositeInterface
     */
    private $composite;

    public function __construct(CommandCompositeInterface $composite)
    {
        $this->composite = $composite;
    }

    /**
     * @return \Epl\CommandCompositeInterface
     */
    public function getComposite()
    {
        return $this->composite;
    }

    /**
     * @return string
     */
    public function toEplString()
    {
        return $this->getComposite()->toEplString();
    }

    /**
     * Renders an ASCII text string to the image print buffer.
     * @param int $horizontalStartPosition
     * @param int $verticalStartPosition
     * @param int $rotation
     * @param int $fontSelection
     * @param int $horizontalMultiplier
     * @param int $verticalMultiplier
     * @param bool $reverseImage
     * @param string $data
     * @param bool $convertRotation
     * @param bool $asianFont
     * @return \Epl\CommandHelper
     * @throw ExceptionCommand
     */
    public function asciiText($horizontalStartPosition, $verticalStartPosition, $rotation, $fontSelection,
                              $horizontalMultiplier, $verticalMultiplier, $reverseImage, $data, $convertRotation = true,
                              $asianFont = false)
    {
        $command = new Command\Image\AsciiTextCommand($horizontalStartPosition, $verticalStartPosition, $rotation, $fontSelection,
            $horizontalMultiplier, $verticalMultiplier, $reverseImage, $data,
            $convertRotation, $asianFont);
        $this->getComposite()->addCommand($command);
        return $this;
    }



    /**
     * Use this command to print standard bar codes
     * @param int $horizontalStartPosition
     * @param int $verticalStartPosition
     * @param int $rotation
     * @param string $barCodeSelection
     * @param int $narrowBarWidth
     * @param int $wideBarWidth
     * @param int $barCodeHeight
     * @param bool $printHumanReadable
     * @param string $data
     * @param bool $convertRotation
     * @return \Epl\CommandHelper
     * @throws \Epl\ExceptionCommand
     */
    public function barCode($horizontalStartPosition, $verticalStartPosition, $rotation, $barCodeSelection,
                            $narrowBarWidth, $wideBarWidth, $barCodeHeight, $printHumanReadable, $data, $convertRotation = true)
    {
        $command = new Command\Image\BarCodeCommand($horizontalStartPosition, $verticalStartPosition, $rotation, $barCodeSelection,
            $narrowBarWidth, $wideBarWidth, $barCodeHeight, $printHumanReadable,
            $data, $convertRotation);
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * @param integer $horizontalStartPosition
     * @param integer $verticalStartPosition
     * @param string $data
     * @param integer $minSquareSize
     * @param integer|null $columnsToEncode
     * @param integer|null $rowsToEncode
     * @param string|null $inverseImage
     * @param string $barCodeSelection
     * @return \Epl\CommandHelper
     */
    public function dataMatrixBarCode($horizontalStartPosition, $verticalStartPosition, $data, $minSquareSize = 5,
                                      $columnsToEncode = null, $rowsToEncode = null, $inverseImage = null, $barCodeSelection = 'D')
    {
        $command = new Command\Image\DataMatrixBarCodeCommand($horizontalStartPosition, $verticalStartPosition, $data, $barCodeSelection,
            $minSquareSize, $columnsToEncode, $rowsToEncode, $inverseImage);
        $this->getComposite()->addCommand($command);

        return $this;
    }

    /**
     * Use this command to print RSS-14 bar code family bar codes for numeric data.
     * @param int $horizontalStartPosition
     * @param int $verticalStartPosition
     * @param int $rotation
     * @param string $barCodeSelection
     * @param int $narrowBarWidth
     * @param int $wideBarWidth
     * @param int $barCodeHeight
     * @param bool $printHumanReadable
     * @param string $data
     * @param bool $convertRotation
     * @return \Epl\CommandHelper
     * @throws \Epl\ExceptionCommand
     */
    public function rss14BarCode($horizontalStartPosition, $verticalStartPosition, $rotation, $barCodeSelection,
                                 $narrowBarWidth, $wideBarWidth, $barCodeHeight, $printHumanReadable, $data, $convertRotation = true)
    {
        $command = new Command\Image\Rss14BarCodeCommand($horizontalStartPosition, $verticalStartPosition, $rotation, $barCodeSelection,
            $narrowBarWidth, $wideBarWidth, $barCodeHeight, $printHumanReadable, $data, $convertRotation);
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * Use this command to select the print density.
     * @param int $density
     * @return \Epl\CommandHelper
     */
    public function density($density)
    {
        $command = new Command\Stored\DensityCommand($density);
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * Use this command to select the appropriate character set for printing (and KDU display)
     * @param int $numberOfDataBits
     * @param string $printerCodePage
     * @param string $KDUCountryCode
     * @throws \Epl\ExceptionCommand
     * @return \Epl\CommandHelper
     */
    public function characterSetSelection($numberOfDataBits = 8, $printerCodePage = '0', $KDUCountryCode = '001')
    {
        $command = new Command\Stored\CharacterSetSelectionCommand($numberOfDataBits, $printerCodePage, $KDUCountryCode);
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * his command disable the Top Of Form Backup feature when printing multiple labels.
     * At power up, Top OF From Backup will be enabled.
     * @return CommandHelper
     */
    public function disableTopOfFormBackup()
    {
        $command = new Command\Stored\DisableTopOfFormBackupCommand();
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * This command disables the Top Of Form Backup feature for all operations.
     * @return CommandHelper
     */
    public function disableTopOfFormBackupAllCases()
    {
        $command = new Command\Stored\DisableTopOfFormBackupAllCasesCommand();
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * This command enables the Top Of Form Backup feature and presents the last label of a batch print operation.
     * Upon request initiating the printing of the next form (or batch), the last label backs up the Top Of Form before
     * printing next label.
     * @return CommandHelper
     */
    public function enableTopOfFormBackup()
    {
        $command = new Command\Stored\EnableTopOfFormBackupCommand();
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * Use this command to draw lines with an "Exclusive OR" function.
     * @param int $horizontalStartPosition
     * @param int $verticalStartPosition
     * @param int $horizontalLength
     * @param int $verticalLength
     * @return \Epl\CommandHelper
     */
    public function lineDrawExclusiveOR($horizontalStartPosition, $verticalStartPosition, $horizontalLength, $verticalLength)
    {
        $command = new Command\Image\LineDrawExclusiveORCommand($horizontalStartPosition, $verticalStartPosition, $horizontalLength, $verticalLength);
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * Use this command to draw black lines, overwriting previous information.
     * @param int $horizontalStartPosition
     * @param int $verticalStartPosition
     * @param int $horizontalLength
     * @param int $verticalLength
     * @return \Epl\CommandHelper
     */
    public function lineDrawBlack($horizontalStartPosition, $verticalStartPosition, $horizontalLength, $verticalLength)
    {
        $command = new Command\Image\LineDrawBlackCommand($horizontalStartPosition, $verticalStartPosition, $horizontalLength, $verticalLength);
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * Use this command to draw diagonal black lines, overwriting previous information.
     * @param int $horizontalStartPosition
     * @param int $verticalStartPosition
     * @param int $horizontalLength
     * @param int $verticalLength
     * @param int $verticalEndPosition
     * @return \Epl\CommandHelper
     */
    public function lineDrawDiagonal($horizontalStartPosition, $verticalStartPosition, $horizontalLength, $verticalLength, $verticalEndPosition)
    {
        $command = new Command\Image\LineDrawDiagonalCommand($horizontalStartPosition, $verticalStartPosition, $horizontalLength, $verticalLength, $verticalEndPosition);
        $this->getComposite()->addCommand($command);
        return $this;
    }



    /**
     * Use this command to draw white lines, effectively erasing previous information.
     * @param int $horizontalStartPosition
     * @param int $verticalStartPosition
     * @param int $horizontalLength
     * @param int $verticalLength
     * @return \Epl\CommandHelper
     */
    public function lineDrawWhite($horizontalStartPosition, $verticalStartPosition, $horizontalLength, $verticalLength)
    {
        $command = new Command\Image\LineDrawWhiteCommand($horizontalStartPosition, $verticalStartPosition, $horizontalLength, $verticalLength);
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * Use this command clears the image buffer prior to building a new label image
     * @return CommandHelper
     */
    public function clearImageBuffer()
    {
        $command = new Command\Image\ClearImageBufferCommand();
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * Use this command to select various printer options
     * @param string $option
     * @param null $additionalOption
     * @throws \Epl\ExceptionCommand
     * @return \Epl\CommandHelper
     */
    public function hardwareOption($option, $additionalOption = null)
    {
        $command = new Command\Stored\HardwareOptionCommand($option, $additionalOption);
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * Use this command to print the contents of the image buffer
     * @param int $numberOfLabels
     * @param null|int $numberOfCopies
     * @throws \Epl\ExceptionCommand
     * @return CommandHelper
     */
    public function printLabel($numberOfLabels, $numberOfCopies = null)
    {
        $command = new Command\PrintCommand($numberOfLabels, $numberOfCopies);
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * Use this command in stored form sequence to automatically print the form (as soon as well variable data has been supplied).
     * @param $numberOfLabels
     * @param null $numberOfCopies
     * @throws \Epl\ExceptionCommand
     * @return CommandHelper
     */
    public function printAutomatic($numberOfLabels, $numberOfCopies = null)
    {
        $command = new Command\Form\PrintAutomaticCommand($numberOfLabels, $numberOfCopies);
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * Use this command to set the width of the printable area of teh media in dots.
     * @param int $width
     * @return CommandHelper
     */
    public function setFormWidth($width)
    {
        $command = new Command\Stored\SetFormWidthCommand($width);
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * Use this command to set the form and gap length or black line thickness when using the transmissive (gap) sensor,
     * @param int $labelLength
     * @param int $gapLength
     * @param int|null $offsetLength
     * @throws \Epl\ExceptionCommand
     * @return CommandHelper
     */
    public function setFormLength($labelLength, $gapLength, $offsetLength = null)
    {
        $command = new Command\Stored\SetFormLengthCommand($labelLength, $gapLength, $offsetLength);
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * Use this command to select the print speed.
     * @param int $speed
     * @return CommandHelper
     */
    public function speed($speed)
    {
        $command = new Command\Stored\SpeedCommand($speed);
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * Use this command to draw a box shape.
     * @param int $horizontalStartPosition
     * @param int $verticalStartPosition
     * @param int $lineThickness
     * @param int $horizontalEndPosition
     * @param int $verticalEndPosition
     * @return CommandHelper
     */
    public function boxDraw($horizontalStartPosition, $verticalStartPosition, $lineThickness,
                            $horizontalEndPosition, $verticalEndPosition)
    {
        $command = new Command\Image\BoxDrawCommand($horizontalStartPosition, $verticalStartPosition, $lineThickness,
            $horizontalEndPosition, $verticalEndPosition);
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * This command signals the printer to ignore the following data.
     * @param string $commentData
     * @return CommandHelper
     */
    public function commentLine($commentData)
    {
        $command = new Command\Form\CommentLineCommand($commentData);
        $this->getComposite()->addCommand($command);
        return $this;
    }
}
