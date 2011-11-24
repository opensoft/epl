<?php

namespace Epl\Command\Stored;

use Epl\CommandAbstract as Command;

/**
 * This command disables the Top Of Form Backup feature for all operations.
 * use this command for liner-less printing and special media cutting modes.
 *
 * This command only is available in the 2824, 2844, and 3842 desktop printer models at this time.
 *
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class DisableTopOfFormBackupAllCasesCommand extends Command
{
    /**
     * @var string
     */
    const NAME = 'JC';

    /**
     * @return string
     */
    protected function getName()
    {
        return self::NAME;
    }
}
