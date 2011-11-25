<?php

namespace Epl\Command\Form;

use Epl\CommandAbstract as Command;

/**
 * This command signals the printer to ignore the following data. All data between the line initiating semicolon charater (;)
 * and the next line feed (LF) character (which terminates all command lines) will be ignored.
 *
 * Supported by firmware versions 4.30 and above.
 *
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
class CommentLineCommand extends Command
{
    /**
     * @var string
     */
    const NAME = ';';

    /**
     * @var string
     */
    private $commentData;

    /**
     * @param string $commentData
     */
    public function __construct($commentData)
    {
        $this->commentData = $commentData;
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
        $result = $this->getName() . ' ' . $this->getCommentData() . $this->getSuffix();
        return $result;
    }

    /**
     * @return string
     */
    public function getCommentData()
    {
        return $this->commentData;
    }
}
