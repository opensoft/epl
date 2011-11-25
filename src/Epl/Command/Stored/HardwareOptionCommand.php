<?php

namespace Epl\Command\Stored;

use Epl\CommandAbstract as Command;
use Epl\ExceptionCommand;

/**
 * Use this command to select various printer options/ Options available vary by printer configuration.
 * Option selected and enabled in a printer can be verified by checking the printer configuration printout,
 * Dump Mode printer status label.
 * Mobile printers, such as the TR 220, ignore this command.
 *
 * Available option value:
 * C  - Enable optional label Printer Cutter. The cutter will cut at the end of each form as specified by he Q command.
 * Cp1 - p1 -Sets the number of labels to print prior to cut.
 *           If a number between 1-255 is specified for p1, the printer will cut after the specified number of labels have been printed.
 *           If "b" is specified for p1, the "batch print & cut" feature is enabled.
 *           This feature uses the P command to control cutter operation.
 * D - Enable direct Thermal mode, use this option when using direct thermal media in a thermal transfer printer.
 * d - Status. Not a command, this is a status only/ Out of box default Direct Thermal Mode setting used in a 2844, 2824,
 *     3842 thermal transfer printers and is displayed in the Dump Mode status printout. Changing the printer to thermal
 *     transfer mode or when the printer detects a transfer ribbon will cause this option parameter to permanently
 *     be removed from the status printout.
 * P - enable label taken sensor for the Label Dispense (Peel) Mode.
 * L - enable the printers Feed button for Tap to Print  operation in the Label Dispense (Peel) Mode. The printer will
 *     present each label and wait for a tap of the Feed button before printing the next label. use this mode
 *     when printing multiple copies of liner-free labels.
 *
 * @see \Epl\Command\PrinterConfiguration
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class HardwareOptionCommand extends Command
{
    /**
     * @var string
     */
    const NAME = 'O';

    /**
     * @var string Hardware option
     */
    private $option;
    private $additionalOption = null;

    private $availableOptions = array (
        'C',
        'D',
        'd',
        'P',
        'L',
        'S',
        'F'
    );

    /**
     * @param string $option
     * @param null $additionalOption
     * @throws \Epl\ExceptionCommand
     */
    public function __construct($option, $additionalOption = null)
    {
        if ($this->isValidHardwareOption($option)) {
            if ($option === 'F' && $additionalOption === null) {
                throw ExceptionCommand::invalidHardwareAdditionalOptionForFeedSettings($additionalOption);
            }

            if ($additionalOption !== null && $this->isValidHardwareAdditionalOption($option, $additionalOption)) {
                $this->additionalOption = $additionalOption;
            }

            $this->option = $option;
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
        $result = $this->getName() . $this->getOption() . $this->getAdditionalOption() . $this->getSuffix();
        return $result;
    }

    /**
     * @param  $option
     * @return bool
     * @throws \Epl\ExceptionCommand
     */
    protected function isValidHardwareOption($option)
    {
        foreach ($this->availableOptions as $acceptedOption) {
            if ($acceptedOption === $option) {
                return true;
            }
        }
        throw ExceptionCommand::invalidHardwareOption($option);
    }

    /**
     * @param  $option
     * @return bool
     * @throws \Epl\ExceptionCommand
     */
    protected function isValidHardwareAdditionalOption($option, $additionalOption)
    {
        if ($option === 'C') {
            return $this->isValidNumberOfLabelsToPrintPriorToCut($additionalOption);
        } elseif ($option === 'F') {
            return $this->isValidTypeFeedSettings($additionalOption);
        }
        throw ExceptionCommand::invalidHardwareAdditionalOption($option, $additionalOption);
    }

    /**
     * @param $additionalOption
     * @return bool
     * @throws \Epl\ExceptionCommand
     */
    protected function isValidNumberOfLabelsToPrintPriorToCut($additionalOption)
    {
        return ($additionalOption === 'b' || $this->isValidIntegerInterval('Number of labels to print cut prior to cut', $additionalOption, 1, 255));
    }

    /**
     * @param $additionalOption
     * @return bool
     * @throws \Epl\ExceptionCommand
     */
    protected function isValidTypeFeedSettings($additionalOption)
    {
        if ($additionalOption === 'f' || $additionalOption === 'r' || $additionalOption === 'i') {
            return true;
        }
        throw ExceptionCommand::invalidHardwareAdditionalOptionForFeedSettings($additionalOption);
    }

    /**
     * @return string
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @return null|string|int
     */
    public function getAdditionalOption()
    {
        return $this->additionalOption;
    }
}
