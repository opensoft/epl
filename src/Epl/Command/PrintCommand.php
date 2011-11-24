<?php

namespace Epl\Command;

use Epl\CommandAbstract as Command;

/**
 * Use this command to print the contents of the image buffer
 *
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class PrintCommand extends Command
{
    /**
     * @var string
     */
    const NAME = 'P';

    /**
     * Number of label sets
     * Accepted Values: 1 to 65535
     * @var int
     */
    private $numberOfLabels;

    /**
     * Number of copies of each label (used in combination with counters to print multiple copies of the same label)
     * Accepted Values: 1 to 65535
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
        if ($this->isValidIntegerInterval('Number of labels', $numberOfLabels, 1, 65535)) {
            $this->numberOfLabels = (int) $numberOfLabels;
        }

        if ($numberOfCopies !== null && $this->isValidIntegerInterval('Number of Copies', $numberOfCopies, 1, 65535)) {
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
