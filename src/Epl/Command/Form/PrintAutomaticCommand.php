<?php

namespace Epl\Command\Form;

use Epl\CommandAbstract as Command;

/**
 * Use this command in stored form sequence to automatically print the form (as soon as well variable data has been supplied).
 *
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class PrintAutomaticCommand extends Command
{
    /**
     * @var string
     */
    const NAME = 'PA';

    /**
     * Number of label sets
     * Accepted Values: 1 to 9999
     * @var int
     */
    private $numberOfLabels;

    /**
     * Number of copies of each label (used in combination with counters) to print multiple copies of the same label.
     * This value is only set when using counters.
     * Accepted Values: 1 to 9999
     * @var null|int
     */
    private $numberOfCopies = null;

    /**
     * @param int $numberOfLabels
     * @param null|int $numberOfCopies
     * @throws \Epl\ExceptionCommand
     */
    public function __construct($numberOfLabels, $numberOfCopies = null)
    {
        if ($this->isValidIntegerInterval('Number of labels', $numberOfLabels, 1, 9999)) {
            $this->numberOfLabels = (int) $numberOfLabels;
        }

        if ($numberOfCopies !== null && $this->isValidIntegerInterval('Number of Copies', $numberOfCopies, 1, 9999)) {
            $this->numberOfCopies = (int) $numberOfCopies;
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
        $result = $this->getName() . $this->getNumberOfLabels();
        if ($this->getNumberOfCopies() !== null) {
            $result .= ',' . $this->getNumberOfCopies();
        }
        return $result . $this->getSuffix();
    }

    /**
     * @return null|int
     */
    public function getNumberOfCopies()
    {
        return $this->numberOfCopies;
    }

    /**
     * @return int
     */
    public function getNumberOfLabels()
    {
        return $this->numberOfLabels;
    }


}
