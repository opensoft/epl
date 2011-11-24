<?php

namespace Epl\Command\Stored;

use Epl\CommandAbstract as Command;
use Epl\ExceptionCommand;

/**
 * Use this command to set the form and gap length or black line thickness when using the transmissive (gap) sensor,
 * black line sensor, or for setting the printer into the continuous media print mode.
 *
 * This command will cause the printer to recalculate and reformat image buffer.
 *
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class SetFormLengthCommand extends Command
{
    /**
     * @var string
     */
    const NAME = 'Q';

    /**
     * @var int Label length measured in dots. Default value: set by the AutoSense of media.
     * Accepted value: 0-65535
     * Distance between edges of the label or black line marks.
     * For continuous mode, this parameter sets the feed distance between the end of one form and beginning of the next.
     */
    private $labelLength;

    /**
     * @var int Gap length or thickness of black line
     * Accepted values:
     * 16-240 for 203 dpi printers
     * 18-240 for 300 dpi printers
     *
     * Gap Mode
     * By default, the printer is in Gap mode and parameters are set with the media AutoSense.
     *
     * Black Line Mode
     * Set this parameter to B plus black line thickness in dots.
     *
     * Continuous Mode
     * Set this parameter to 0 (zero)/ The transmissive (gap) sensor will beused to detect the end of media.
     */
    private $gapLength;

    /**
     * Required for black line mode operation.
     *
     * Optional for Gap detect or continuous media modes. Use only positive offset values.
     * @var int|null Offset length measured in dots
     */
    private $offsetLength = null;

    /**
     * @param int $labelLength
     * @param int $gapLength
     * @param int|null $offsetLength
     * @throws \Epl\ExceptionCommand
     */
    public function __construct($labelLength, $gapLength, $offsetLength = null)
    {
        if ($this->isValidIntegerInterval('Label length', $labelLength, 0, 65535)) {
            $this->labelLength = $labelLength;
        }

        if ($this->isValidIntegerInterval('Gap length', $gapLength, 16, 240)) {
            $this->gapLength = $gapLength;
        }

        if ($offsetLength !== null && $this->isValidIntegerInterval('Offset length', $offsetLength, 0, 65535)) {
            $this->offsetLength = $offsetLength;
        }
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
        $result = $this->getName() . $this->getLabelLength() . ',' . $this->getGapLength();
        if ($this->offsetLength !== null) {
            $result .= '+' . $this->getOffsetLength();
        }
        return $result . $this->getSuffix();
    }

    /**
     * @return int
     */
    public function getGapLength()
    {
        return $this->gapLength;
    }

    /**
     * @return int
     */
    public function getLabelLength()
    {
        return $this->labelLength;
    }

    /**
     * @return int|null
     */
    public function getOffsetLength()
    {
        return $this->offsetLength;
    }
}
