<?php
/*
* This file is part of ProFIT
*
* Copyright (c) 2011 Farheap Solutions (http://www.farheap.com)
*
* The unauthorized use of this code outside the boundaries of
* Farheap Solutions Inc. is prohibited.
*/
namespace Epl\Command\Stored;

use Epl\CommandAbstract as Command;

/**
 * Use this command to select the print speed.
 *
 * Mobile printers, such as the TR 220, ignore this command and authomatically set to optimaze battery use.
 *
 * This table identifies the parameters for this format:
 *
 * Model  ||  Value  ||  Speed
 * 2722   ||  0      ||  1.0 ips (25 mm/s)
 * 2742   ||  1      ||  1.5 ips (37 mm/s)
 * 3742   ||  2      ||  2.0 ips (50 mm/s)
 * 3842   ||         ||
 * ----------------------------------------
 * 2824   ||  1      ||  1.5 ips (37 mm/s)
 * 2844   ||  2      ||  2.0 ips (50 mm/s)
 * ....   ||  3      ||  2.5 ips (63 mm/s)
 * ....   ||  4      ||  3.5 ips (83 mm/s)
 * ----------------------------------------
 * 2443   ||  1      ||  1.5 ips (37 mm/s)
 *        ||  2      ||  2.0 ips (50 mm/s)
 *        ||  3      ||  2.5 ips (63 mm/s)
 * ----------------------------------------
 * 2746   ||  2      ||  2.0 ips (50 mm/s)
 * 2746e  ||  3      ||  3.0 ips (50 mm/s)
 * 2348   ||  4      ||  4.0 ips (50 mm/s)
 *        ||  5      ||  5.0 ips (50 mm/s)
 *        ||  6      ||  6.0 ips (50 mm/s)
 * ----------------------------------------
 * 2684   ||  1      ||  1.0 ips (25 mm/s)
 *        ||  2      ||  2.0 ips (50 mm/s)
 *        ||  3      ||  3.0 ips (50 mm/s)
 *        ||  4      ||  4.0 ips (50 mm/s)
 * ----------------------------------------
 *
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class SpeedCommand extends Command
{
    /**
     * @var string
     */
    const NAME = 'S';

    /**
     * @var int
     */
    private $speed;

    /**
     * @param int $speed
     */
    public function __construct($speed)
    {
        $this->speed = $speed;
    }

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
        $result = $this->getName() . $this->getSpeed() . $this->getSuffix();
        return $result;
    }

    /**
     * @return int
     */
    public function getSpeed()
    {
        return $this->speed;
    }
}
