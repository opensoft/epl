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
 * Use this command to draw lines with an "Exclusive OR" function. Any area, line, image or field that this line intersects
 * or overlays will have the image reversed or inverted (sometimes known as reserve video or a negative image). In other
 * words, all black will be reversed to white and all white be reversed to black within the line's area (width and length).
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class LineDrawExclusiveORCommand extends Command
{
    const NAME = 'LE';
    /**
     * @return string
     */
    protected function getName()
    {
        return self::NAME;
    }
}
