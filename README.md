The library is a php wrapper for the EPL2 Programming Language. At present do not support all commands EPL2.

[![Build Status](https://travis-ci.org/opensoft/epl.png?branch=master)](https://travis-ci.org/opensoft/epl)

<h2>Usage:</h2>

<pre>

&lt;?php
use Epl\CommandComposite;
use Epl\CommandHelper;

$composite = new Composite();
$commandHelper = new CommandHelper($composite);
//Draw new line
$commandHelper-&gt;lineDrawBlack(50, 200, 400, 20);
//Draw other line
$commandHelper-&gt;lineDrawBlack(200, 50, 20, 400);
//Print 1 label
$commandHelper-&gt;print(1);
//Get EPL string
$eplString = $commandHelper-&gt;toEplString();
</pre>

<p>To implement the commands necessary to implement Epl\CommandInterface.</p>

<p>For convenience of use EPL commands there is a CommandHelper. It hides the implementation EPL commands.
But you can direct way to instantiate the command.</p>

<pre>
&lt;?php
use Epl\Command\PrintCommand;
use Epl\Command\CommandComposite;

$commandComposite = new CommandComposite();
$printCommand = new PrintCommand(1);
$commandComposite-&gt;addCommand($printCommand);
$eplString = $commandComposite-&gt;toEplString();
</pre>

<h2>Installation</h2>

```php composer.phar require opensoft/epl```

<h2>Installation on Symfony 2 project</h2>
If you use a deps file, add:</p>

<pre>
[epl]
    git=http://github.com/opensoft/epl.git
</pre>

<p>Or if you want to clone the repos:</p>

<pre>
git clone git://github.com/opensoft/epl.git vendor/epl
</pre>

<p>Add the namespace to your autoloader</p>

<pre>
$loader-&gt;registerNamespaces(array(
    ............
    'Epl'   =&gt; <strong>DIR</strong>.'/../vendor/epl/src',
    ...........
));
</pre>

<h2>List of commands</h2>
<table>
  <tr>
<th>EPL</th>
<th>Description</th>
<th>Status</th>
<th>Class</th>
<th>Helper Method</th>
</tr><tr>
<td> A </td>
<td> ASCII Text </td>
<td> Partial </td>
<td> Epl\Command\Image\AsciiTextCommand </td>
<td> asciiText </td>
</tr><tr>
<td> AUTOFR </td>
<td> Automatic Form Printing </td>
<td> Not implemented </td>
<td> </td>
<td> </td>
</tr><tr>
<td> B </td>
<td> Bar Code </td>
<td> Complete </td>
<td> Epl\Command\Image\BarCodeCommand </td>
<td> barCode </td>
</tr><tr>
<td> B </td>
<td> RSS-14 Bar Code </td>
<td> Complete </td>
<td> Epl\Command\Image\Rss14BarCodeCommand </td>
<td> rss14BarCode </td>
</tr><tr>
<td> b </td>
<td> 2D Data Matrix Bar Code </td>
<td> Complete </td>
<td> Epl\Command\Image\DataMatrixBarCodeCommand </td>
<td> dataMatrixBarCode </td>
</tr><tr>
<td> D </td>
<td> Density </td>
<td> Complete </td>
<td> Epl\Command\Stored\DensityCommand </td>
<td> density </td>
</tr><tr>
<td> I </td>
<td> Character Set Selection </td>
<td> Complete </td>
<td> Epl\Command\Stored\CharacterSetSelectionCommand </td>
<td> characterSetSelection </td>
</tr><tr>
<td> JB </td>
<td> Disable Top Of Form Backup </td>
<td> Complete </td>
<td> Epl\Command\Stored\DisableTopOfFormBackupCommand </td>
<td> disableTopOfFormBackup </td>
</tr><tr>
<td> JC </td>
<td> Disable Top Of Form Backup - All Cases </td>
<td> Complete </td>
<td> Epl\Command\Stored\DisableTopOfFormBackupAllCasesCommand </td>
<td> disableTopOfFormBackupAllCases </td>
</tr><tr>
<td> JF </td>
<td> Enable Top Of Form Backup </td>
<td> Complete </td>
<td> Epl\Command\Stored\EnableTopOfFormBackupCommand </td>
<td> enableTopOfFormBackup </td>
</tr><tr>
<td> LE </td>
<td> Line Draw Exclusive OR </td>
<td> Complete </td>
<td> Epl\Command\Image\LineDrawExclusiveORCommand </td>
<td> lineDrawExclusiveOR </td>
</tr><tr>
<td> LO </td>
<td> Line draw black </td>
<td> Complete </td>
<td> Epl\Command\Image\LineDrawBlackCommand </td>
<td> lineDrawBlack </td>
</tr><tr>
<td> LS </td>
<td> Line draw diagonal </td>
<td> Complete </td>
<td> Epl\Command\Image\LineDrawDiagonalCommand </td>
<td> lineDrawDiagonal </td>
</tr><tr>
<td> LW </td>
<td> Line draw white </td>
<td> Complete </td>
<td> Epl\Command\Image\LineDrawWhiteCommand </td>
<td> lineDrawWhite </td>
</tr><tr>
<td> N </td>
<td> Clear Image Buffer </td>
<td> Complete </td>
<td> Epl\Command\Image\ClearImageBufferCommand </td>
<td> clearImageBuffer </td>
</tr><tr>
<td> O </td>
<td> Options Select </td>
<td> Complete </td>
<td> Epl\Command\Stored\HardwareOptionCommand </td>
<td> hardwareOption </td>
</tr><tr>
<td> P </td>
<td> Print </td>
<td> Complete </td>
<td> Epl\Command\PrintCommand </td>
<td> printLabel </td>
</tr><tr>
<td> PA </td>
<td> Print Automatic </td>
<td> Complete </td>
<td> Epl\Command\Form\PrintAutomaticCommand </td>
<td> printAutomatic </td>
</tr><tr>
<td> q </td>
<td> Set Form Width </td>
<td> Complete </td>
<td> Epl\Command\Stored\SetFormWidthCommand </td>
<td> setFormWidth </td>
</tr><tr>
<td> Q </td>
<td> Set Form Length </td>
<td> Complete </td>
<td> Epl\Command\Stored\SetFormLengthCommand </td>
<td> setFormLength </td>
</tr><tr>
<td> S </td>
<td> Speed Select </td>
<td> Complete </td>
<td> Epl\Command\Stored\SpeedCommand </td>
<td> speed </td>
</tr><tr>
<td> X </td>
<td> Box Draw </td>
<td> Complete </td>
<td> Epl\Command\Image\BoxDrawCommand </td>
<td> boxDraw </td>
</tr><tr>
<td> GW </td>
<td> Direct Graphic Write </td>
<td> Complete </td>
<td> Epl\Command\Image\GraphicWriteCommand </td>
<td> graphicWrite </td>
</tr><tr>
<td> ; </td>
<td> Code comment line </td>
<td> Complete </td>
<td> Epl\Command\Form\CommentLineCommand </td>
<td> commentLine </td>
</tr>
</table>
