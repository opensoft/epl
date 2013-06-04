<?php


namespace Epl\Command\Image;

use Epl\CommandAbstract as Command;
use Epl\ExceptionCommand;

/**
 * Use this command to print 2D bar codes
 *
 * @author Maria Plyasunova <maria.plyasunova@opensoftdev.ru>
 */
abstract class BarCode2DCommandAbstract extends Command
{
    /**
     * @var string
     */
    const NAME = 'b';

    /**
     * @var int Horizontal start position (X) in dots
     */
    protected $horizontalStartPosition;

    /**
     * @var int Vertical start position (Y) in dots
     */
    protected $verticalStartPosition;

    /**
     * @var string Bar code selection
     */
    protected $barCodeSelection;

    /**
     * The data in this field must comply with the selected bar code's specified format.
     * The backslash (\) character designates the following character is a literal
     * and will encode into the data field
     * @var string
     */
    protected $data;

    /**
     * @return string
     */
    protected function getName()
    {
        return self::NAME;
    }


    /**
     * @param string $data
     * @return string
     */
    protected function escapeData($data)
    {
        return str_replace(array('\\', '"'), array('\\\\', '\"'), $data);
    }

    /**
     * @abstract
     * @return array
     */
    abstract protected function getAvailableBarCodeSelection();

    /**
     * @param $barCodeSelection
     * @return bool
     * @throws \Epl\ExceptionCommand
     */
    protected function isValidBarCodeSelection($barCodeSelection)
    {
        foreach ($this->getAvailableBarCodeSelection() as $availableBarCode) {
            if ($availableBarCode === (string) $barCodeSelection) {
                return true;
            }
        }
        throw ExceptionCommand::invalidBarCodeSelection($barCodeSelection);
    }

    /**
     * @return string
     */
    public function getBarCodeSelection()
    {
        return $this->barCodeSelection;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getHorizontalStartPosition()
    {
        return $this->horizontalStartPosition;
    }

    /**
     * @return int
     */
    public function getVerticalStartPosition()
    {
        return $this->verticalStartPosition;
    }
}
