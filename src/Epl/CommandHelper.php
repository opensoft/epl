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
     * @return CommandHelper
     */
    public function disableTopOfFormBackup()
    {
        $command = new Command\Stored\DisableTopOfFormBackupCommand();
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * @return CommandHelper
     */
    public function disableTopOfFormBackupAllCases()
    {
        $command = new Command\Stored\DisableTopOfFormBackupAllCasesCommand();
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
     * @return CommandHelper
     */
    public function enableTopOfFormBackup()
    {
        $command = new Command\Stored\EnableTopOfFormBackupCommand();
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
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
     * @return CommandHelper
     */
    public function clearImageBuffer()
    {
        $command = new Command\Image\ClearImageBufferCommand();
        $this->getComposite()->addCommand($command);
        return $this;
    }

    /**
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
