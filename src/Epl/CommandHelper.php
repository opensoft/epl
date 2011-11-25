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
    }
}
