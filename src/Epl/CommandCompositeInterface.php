<?php

namespace Epl;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
interface CommandCompositeInterface
{
    /**
     * @abstract
     * @param CommandInterface $command
     * @return CommandCompositeInterface
     */
    public function addCommand(CommandInterface $command);

    /**
     * @abstract
     * @return CommandInterface[]
     */
    public function getCommands();
}
