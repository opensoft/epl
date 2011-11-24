The library is a php wrapper for the EPL2 Programming Language. At present do not support all commands EPL2.

Usage:

<?php
use Epl\Command\CommandFacade;

$commandFacade = mew CommandFacade();
//Draw new line
$commandFacade->addLineDrawBlack(50, 200, 400, 20);
//Draw other line
$commandFacade->addLineDrawBlack(200, 50, 20, 400);
//Print 1 label
$commandFacade->addPrint(1);
//Get EPL string
$eplString = $commandFacade->toEplString();


To implement the commands necessary to implement Epl\CommandInterface.

For convenience of use EPL commands there is a CommandFacade. It hides the implementation EPL commands.
But you can direct way to instantiate the command.

<?php
use Epl\Command\PrintCommand;
use Epl\Command\CommandFacade;

$commandFacade = mew CommandFacade();
$printCommand = new PrintCommand(1);
$commandFacade->addCommand($printCommand);
$eplString = $commandFacade->toEplString();
