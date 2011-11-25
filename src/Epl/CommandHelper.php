<?php

namespace Epl;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class CommandHelper implements CommandHelperInterface
{
    /**
     * @var \Epl\CommandCompositeInterface
     */
    private $composite;

    public function __construct(CommandCompositeInterface $composite)
    {
        $this->composite = $composite;
    }

    /**
     * @return \Epl\CommandCompositeInterface
     */
    public function getComposite()
    {
        return $this->composite;
    }

    /**
     * @return string
     */
    public function toEplString()
    {
        return $this->getComposite()->toEplString();
    }
}
