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
                            $narrowBarWidth, $wideBarWidth, $barCodeHeight, $printHumanReadable, $data, $convertRotation)
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
                                 $narrowBarWidth, $wideBarWidth, $barCodeHeight, $printHumanReadable, $data, $convertRotation)
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
     * @return \Epl\CommandHelper
     * @throws \Epl\ExceptionCommand
     */
    public function characterSetSelection($numberOfDataBits, $printerCodePage, $KDUCountryCode)
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
}
