<?php

namespace Epl;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
interface CommandFacadeInterface
{
    /**
     * @abstract
     * @param CommandInterface $command
     * @return CommandFacadeInterface
     */
    public function addCommand(CommandInterface $command);

    /**
     * @abstract
     * @return CommandInterface[]
     */
    public function getCommands();
}
