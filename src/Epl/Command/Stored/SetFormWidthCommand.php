<?php

namespace Epl\Command\Stored;

use Epl\CommandAbstract as Command;

/**
 * Use this command to set the width of the printable area of teh media in dots.
 *
 * This command will be cause the buffer to reformat and position to match the selected label width parameter.
 *
 * For all EPL desktop printers, this command will automatically set the left margin according to the following rules^
 * (print_head_width - label_width) / 2
 *
 * The q value affects the available print width. Minimizing the q value will maximize the print length and print speed
 * (double buffering).
 *
 * If the SetReferenceCommand (R) is sent after this command, the image buffer will be automatically reformatted to match
 * the width of the print head and is offset by the R command specified image buffer starting point, nullifying the q command.
 *
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class SetFormWidthCommand extends Command
{
    /**
     * @var string
     */
    const NAME = 'q';

    /**
     * @var int
     */
    private $width;

    /**
     * @param int $width
     */
    public function __construct($width)
    {
        $this->width = (int) $width;
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
        $result = $this->getName() . $this->getWidth() .  $this->getSuffix();
        return $result;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }
}
