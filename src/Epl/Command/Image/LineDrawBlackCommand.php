<?php
/*
* This file is part of ProFIT
*
* Copyright (c) 2011 Farheap Solutions (http://www.farheap.com)
*
* The unauthorized use of this code outside the boundaries of
* Farheap Solutions Inc. is prohibited.
*/
namespace Epl\Command\Image;

use Epl\Command\Image\LineDrawCommandAbstract as Command;
use Epl\ExceptionCommand;

/**
 * Use this command to draw black lines, overwriting previous information.
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class LineDrawBlackCommand extends Command
{
    const NAME = 'LO';
    /**
     * @return string
     */
    protected function getName()
    {
        return self::NAME;
    }
}
