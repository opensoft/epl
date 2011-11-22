<?php
/*
* This file is part of ProFIT
*
* Copyright (c) 2011 Farheap Solutions (http://www.farheap.com)
*
* The unauthorized use of this code outside the boundaries of
* Farheap Solutions Inc. is prohibited.
*/
namespace Epl\Command;

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

    public function toEplString()
    {
        $result = chr(13) . chr(10) . $this->getName();
        return $result;
    }
}
