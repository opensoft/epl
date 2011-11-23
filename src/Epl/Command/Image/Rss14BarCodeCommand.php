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

use Epl\Command\Image\BarCodeCommandAbstract as Command;
use Epl\ExceptionCommand;

/**
 * Use this command to print RSS-14 bar code family bar codes for numeric data.
 * The printer supports a subset of the RSS bar code family set. The subset includes basic RSS-14,
 * RSS Limited, RSS Stacked and RSS Truncated. The printer does not support RSS Expanded or two dimensional composite bar codes.
 *
 * Printer Models: 3842 and 2844 *
 * * - Available as a firmware download from the www.zebra.com website
 *
 * @todo The data fields to be refined according to the documentation EPL2
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class Rss14BarCodeCommand extends Command
{
    protected $availableBarCodeSelection = array(
        'R14', 'RL', 'RS', 'RT'
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
