<?php

namespace Epl\Command\Image;

use Epl\CommandAbstract as Command;

/**
 * Use this command clears the image buffer prior to building a new label image
 *
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class ClearImageBufferCommand extends Command
{
    /**
     * @var string
     */
    const NAME = 'N';

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
        $result = $this->getPrefix() . $this->getName() . $this->getSuffix();
        return $result;
    }

    /**
     * @return string
     */
    private function getPrefix()
    {
        return chr(10);
    }
}
