<?php

namespace Epl;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
interface CommandCompositeInterface extends CommandInterface
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

    /**
     * @abstract
     * @return CommandCompositeInterface
     */
    public function clearCommands();
}
