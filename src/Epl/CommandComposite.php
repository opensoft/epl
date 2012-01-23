<?php

namespace Epl;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
final class CommandComposite implements CommandCompositeInterface
{
    /**
     * @var array|CommandInterface[]
     */
    protected $commands = array();

    /**
     * @param CommandInterface $command
     * @return \Epl\CommandComposite
     */
    public function addCommand(CommandInterface $command)
    {
        $this->commands[] = $command;
        return $this;
    }

    /**
     * @return CommandInterface[]
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * @return null|string
     */
    public function toEplString()
    {
        $eplString = null;
        if (! empty($this->commands)) {
            foreach ($this->getCommands() as $command) {
                $eplString .= $command->toEplString();
            }
        }
        return $eplString;
    }

    /**
     * @return CommandCompositeInterface
     */
    public function clearCommands()
    {
        $this->commands = array();
        return $this;
    }
}
