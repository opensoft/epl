<?php

namespace Epl\Command\Stored;

use Epl\CommandAbstract as Command;

/**
 * Use this command to select the print density. The density command controls the amount of heat produced by the print head.
 * More heat will produce a darker image. Too much heat can cause the printed image to distort.
 *
 * The density and speed commands can dramatically affect print quality. Changes in the speed settings typically require
 * a change to the print density
 *
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class DensityCommand extends Command
{
    /**
     * @var string
     */
    const NAME = 'D';

    /**
     * Accepted Values: 0-15
     * Default Value:
     * 2443 (Orion) and 2884: 10
     * All other printers: 7
     * Note 0 is the lightest print and 15 is the darkest
     * @var int Density setting
     */
    private $density;

    /**
     * @param int $density
     */
    public function __construct($density)
    {
        if ($this->isValidIntegerInterval('Density', $density, 0, 15)) {
            $this->density = $density;
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
        $result = $this->getName() . $this->getDensity() . $this->getSuffix();
        return $result;
    }

    /**
     * @return int
     */
    public function getDensity()
    {
        return $this->density;
    }
}
