<?php

namespace Epl;

use Epl\ExceptionCommand;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
abstract class CommandAbstract implements CommandInterface
{
    /**
     * @return string
     */
    public function toEplString()
    {
        return $this->getName(). $this->getSuffix();
    }

    /**
     * @abstract
     * @return string
     */
    abstract protected function getName();

    /**
     * @param string $name
     * @param int $value
     * @param int $min
     * @param int $max
     * @return bool
     * @throws ExceptionCommand
     */
    protected function isValidIntegerInterval ($name, $value, $min, $max)
    {
        if ($value < $min || $value > $max) {
            throw ExceptionCommand::invalidIntegerParameter($name, $value, $min, $max);
        }
        return true;
    }

    /**
     * @return string
     */
    protected function getSuffix()
    {
        return chr(10);
    }
}
