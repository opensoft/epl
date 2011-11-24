<?php

namespace Epl;

/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class ExceptionCommand extends \Exception
{
    /**
     * @static
     * @param string $name
     * @param $value
     * @param int $min
     * @param int $max
     * @return ExceptionCommand
     */
    public static function invalidIntegerParameter($name, $value, $min, $max)
    {
        return new self ('Accepted values: ' . $min .' to ' . $max .'. ' . $name . ' is ' .$value . '.');
    }

    /**
     * @static
     * @param $barcode
     * @return ExceptionCommand
     */
    public static function invalidBarCodeSelection($barcode)
    {
        return new self ($barcode . ' is invalid barcode selection');
    }

    /**
     * @static
     * @param $degree
     * @return ExceptionCommand
     */
    public static function invalidDegree($degree)
    {
        return new self ($degree . ' is invalid degree value');
    }

    /**
     * @static
     * @param $value
     * @return ExceptionCommand
     */
    public static function invalidNumberOfDataBits($value)
    {
        return new self ($value . ' is invalid number of data bits');
    }

    /**
     * @static
     * @param int $bit
     * @param $printerCodePage
     * @return ExceptionCommand
     */
    public static function invalidPrinterCodePage($bit, $printerCodePage)
    {
        return new self ($printerCodePage . ' is invalid for ' . $bit . 'bit data');
    }

    public static function invalidKDUCountryCode($countryCode)
    {
        return new self ($countryCode . 'is invalid KDU country code');
    }
}
