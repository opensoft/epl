<?php

namespace Epl\Command\Image;

use Epl\Command\Image\BarCodeCommandAbstract as Command;
use Epl\ExceptionCommand;

/**
 * Use this command to print standard bar codes
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class BarCodeCommand extends Command
{
    protected $availableBarCodeSelection = array(
        '3', '3C', '9', '0', '1', '1A', '1B', '1C', '1D', 'K', 'E80', 'E82', 'E85', 'E30', 'E32', 'E35', '2G', '2', '2C',
        '2D', 'P', 'PL', 'J', '1E', 'UA0', 'UA2', 'UA5', 'UE0', 'UE2', '2U', 'L', 'M'
    );

    /**
     * @todo The code needs to be refined according to the documentation EPL2
     * @param $narrowBarWidth
     * @throws ExceptionCommand
     * @return bool
     */
    protected function isValidNarrowBarWidth($narrowBarWidth)
    {
        return $this->isValidIntegerInterval('Narrow bar width', $narrowBarWidth, 1, 10);
    }

    /**
     * @todo The code needs to be refined according to the documentation EPL2
     * @param $wideBarWidth
     * @throws ExceptionCommand
     * @return bool
     */
    protected function isValidWideBarWidth($wideBarWidth)
    {
        return $this->isValidIntegerInterval('Wide bar width', $wideBarWidth, 2, 30);
    }

    /**
     * @return array
     */
    protected function getAvailableBarCodeSelection()
    {
        return $this->availableBarCodeSelection;
    }

}
