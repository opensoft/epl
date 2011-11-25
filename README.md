The library is a php wrapper for the EPL2 Programming Language. At present do not support all commands EPL2.

===Usage:===

<syntaxhighlight lang="php">
<?php
use Epl\CommandComposite;
use Epl\CommandHelper;

$composite = new Composite();
$commandHelper = mew CommandHelper($composite);
//Draw new line
$commandHelper->lineDrawBlack(50, 200, 400, 20);
//Draw other line
$commandHelper->lineDrawBlack(200, 50, 20, 400);
//Print 1 label
$commandHelper->print(1);
//Get EPL string
$eplString = $commandHelper->toEplString();
</syntaxhighlight>


To implement the commands necessary to implement Epl\CommandInterface.

For convenience of use EPL commands there is a CommandHelper. It hides the implementation EPL commands.
But you can direct way to instantiate the command.

<syntaxhighlight lang="php">
<?php
use Epl\Command\PrintCommand;
use Epl\Command\CommandComposite;

$commandComposite = mew CommandComposite();
$printCommand = new PrintCommand(1);
$commandComposite->addCommand($printCommand);
$eplString = $commandComposite->toEplString();
</syntaxhighlight>


===Installation on Symfony 2 project====
If you use a deps file, add:

<code>
[epl]
    git=http://github.com/opensoft/epl.git

</code>

Or if you want to clone the repos:

<code>
git clone git://github.com/opensoft/epl.git vendor/epl
</code>

Add the namespace to your autoloader

<syntaxhighlight lang="php">
$loader->registerNamespaces(array(
    ............
    'Epl'   => __DIR__.'/../vendor/epl/src',
    ...........
));
</syntaxhighlight>

===List of commands===
{| class="wikitable"
|-
! EPL
! Description
! Status
! Class
! Helper Method
|-
| A
| ASCII Text
| Partial
| Epl\Command\Image\AsciiTextCommand
| asciiText
|-
| AUTOFR
| Automatic Form Printing
| Not implemented
|
|
|-
| B
| Bar Code
| Complete
| Epl\Command\Image\BarCodeCommand
| barCode
|-
| B
| RSS-14 Bar Code
| Complete
| Epl\Command\Image\Rss14BarCodeCommand
| rss14BarCode
|-
| D
| Density
| Complete
| Epl\Command\Stored\DensityCommand
| density
|-
| I
| Character Set Selection
| Complete
| Epl\Command\Stored\CharacterSetSelectionCommand
| characterSetSelection
|-
| JB
| Disable Top Of Form Backup
| Complete
| Epl\Command\Stored\DisableTopOfFormBackupCommand
| disableTopOfFormBackup
|-
| JC
| Disable Top Of Form Backup - All Cases
| Complete
| Epl\Command\Stored\DisableTopOfFormBackupAllCasesCommand
| disableTopOfFormBackupAllCases
|-
| JF
| Enable Top Of Form Backup
| Complete
| Epl\Command\Stored\EnableTopOfFormBackupCommand
| enableTopOfFormBackup
|-
| LE
| Line Draw Exclusive OR
| Complete
| Epl\Command\Image\LineDrawExclusiveORCommand
| lineDrawExclusiveOR
|-
| LO
| Line draw black
| Complete
| Epl\Command\Image\LineDrawBlackCommand
| lineDrawBlack
|-
| LS
| Line draw diagonal
| Complete
| Epl\Command\Image\LineDrawDiagonalCommand
| lineDrawDiagonal
|-
| LW
| Line draw white
| Complete
| Epl\Command\Image\LineDrawWhiteCommand
| lineDrawWhite
|-
| N
| Clear Image Buffer
| Complete
| Epl\Command\Image\ClearImageBufferCommand
| clearImageBuffer
|-
| O
| Options Select
| Complete
| Epl\Command\Stored\HardwareOptionCommand
| hardwareOption
|-
| P
| Print
| Complete
| Epl\Command\PrintCommand
| print
|-
| PA
| Print Automatic
| Complete
| Epl\Command\Form\PrintAutomaticCommand
| printAutomatic
|-
| q
| Set Form Width
| Complete
| Epl\Command\Stored\SetFormWidthCommand
| setFormWidth
|-
| Q
| Set Form Length
| Complete
| Epl\Command\Stored\SetFormLengthCommand
| setFormLength
|-
| S
| Speed Select
| Complete
| Epl\Command\Stored\SpeedCommand
| speed
|-
| X
| Box Draw
| Complete
| Epl\Command\Image\BoxDrawCommand
| boxDraw
|-
| ;
| Code comment line
| Complete
| Epl\Command\Form\CommentLineCommand
| commentLine
|}

