<?php

namespace Epl\Command\Stored;

use Epl\CommandAbstract as Command;

/**
 * This command disable the Top Of Form Backup feature when printing multiple labels.
 * At power up, Top OF From Backup will be enabled.
 *
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class DisableTopOfFormBackupCommand extends Command
{
    /**
     * @var string
     */
    const NAME = 'JB';

    /**
     * @return string
     */
    protected function getName()
    {
        return self::NAME;
    }
}
