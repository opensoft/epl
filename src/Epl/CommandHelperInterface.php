<?php

namespace Epl;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
interface CommandHelperInterface extends CommandInterface
{
    /**
     * @abstract
     * @return CommandCompositeInterface
     */
    public function getComposite();
}
