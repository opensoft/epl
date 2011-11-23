<?php
/*
* This file is part of ProFIT
*
* Copyright (c) 2011 Farheap Solutions (http://www.farheap.com)
*
* The unauthorized use of this code outside the boundaries of
* Farheap Solutions Inc. is prohibited.
*/
namespace Epl;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class ExceptionCommand extends \Exception
{
    public static function notValidIntegerParameter($name, $value, $min, $max)
    {
        return new self ('Accepted values: ' . $min .' to ' . $max .'. ' . $name . ' is ' .$value . '.');
    }

    public static function invalidBarCodeSelection($barcode)
    {
        return new self ($barcode . ' is invalid barcode selection');
    }

    public static function invalidDegree($degree)
    {
        return new self ($degree . ' is invalid degree value');
    }
}
