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
     * @var null|string
     */
    protected $eplString = null;

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
        if (! empty($this->commands)) {
            foreach ($this->getCommands() as $command) {
                $this->eplString .= $command->toEplString();
            }
        }
        return $this->eplString;
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
