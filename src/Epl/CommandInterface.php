<?php

namespace Epl;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
interface CommandInterface
{
    /**
     * @abstract
     * @return string
     */
    public function toEplString();
}
