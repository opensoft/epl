<?php

namespace Epl\Command\Stored;

use Epl\CommandAbstract as Command;

/**
 * This command enables the Top Of Form Backup feature and presents the last label of a batch print operation.
 * Upon request initiating the printing of the next form (or batch), the last label backs up the Top Of Form before
 * printing next label.
 *
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class EnableTopOfFormBackupCommand extends Command
{
    /**
     * @var string
     */
    const NAME = 'JF';

    /**
     * @return string
     */
    protected function getName()
    {
        return self::NAME;
    }
}
