<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\url;

$header = $header ?? null;
$message = $message ?? null;

//var_dump($_SESSION)


?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<?php if ($gameStatus === "setupDiceBoard") : ?>
    <form method ="post" action="<?= url("/dice-setupDiceBoard")?>">
    <p>Please choose between 1 or 2 dice.</p>

    <input type="radio" id="oneDie" name="dice" value="1">
    <label for="onedie">One die</label><br>

    <input type="radio" id="twoDice" name="dice" value="2" checked>
    <label for="twoDice">Two dice</label><br>

    <input type="hidden" id="graphicalDice" name="diceType" value="graphical">

    <input type = "submit" id="submit" name="doit" value = "Start game">
    </form>
<?php endif;?>

<?php if ($gameStatus === "humanTurn") : ?>
    <?php if ($winningNumber) : ?>
        <h2><?= $winningNumber ?></h2>
    <?php endif;?>
    <form method ="post" action="<?= url("/dice-human-roll")?>">
    <input type="submit" id="submit" name="doit" value="Roll Dice"><br><br>
    </form>

    <?php if ($humanRoll) : ?>
    <p>Human rolled dice:</p>
    <p><?= $humanRoll?> = <?=$sumOfHumanRoll ?></p>
    <?php endif;?>

    <?php if ($showHumansGraphicalDice) : ?>
        <p>
        <?php foreach ($showHumansGraphicalDice as $value) : ?>
            <i class="dice-sprite <?= $value ?>"></i>
        <?php endforeach; ?>
        </p>
    <?php endif;?>

    <?php if ($humanRoll) : ?>
    <p>Humans total score:</p>
    <p><?=$showResultOfHumansLatestRoll?> = <?= $humansTotalScore?></p>
    <?php endif;?>

    <?php if ($showResultOfHumansLatestRollGraphiclly) : ?>
        <p>
        <?php foreach ($showResultOfHumansLatestRollGraphiclly as $value) : ?>
            <i class="dice-sprite <?= $value ?>"></i>
        <?php endforeach; ?>
        </p>
    <?php endif;?>

    <form method ="post" action="<?= url("/dice-human-stop")?>">
    <input type = "submit" id="submit" name="doit" value = "Stop Rolling Dice">
    </form>
<?php endif;?>

<?php if ($gameStatus === "machineTurn") : ?>
    <p>Humans total score:</p>
    <p><?=$showResultOfHumansLatestRoll?> = <?= $humansTotalScore?></p>

    <?php if ($showResultOfHumansLatestRollGraphiclly) : ?>
        <p>
        <?php foreach ($showResultOfHumansLatestRollGraphiclly as $value) : ?>
            <i class="dice-sprite <?= $value ?>"></i>
        <?php endforeach; ?>
        </p>
    <?php endif;?>

    <p>Machines total score:</p>
    <p><?=$showResultOfMachinesLatestRoll?> = <?= $machineTotalScore?></p>

    <?php if ($showResultOfMachinesLatestRollGraphiclly) : ?>
        <p>
        <?php foreach ($showResultOfMachinesLatestRollGraphiclly as $value) : ?>
            <i class="dice-sprite <?= $value ?>"></i>
        <?php endforeach; ?>
        </p>
    <?php endif;?>
<?php endif;?>

<?php if ($gameStatus === "gameOver") : ?>
    <h2><?=$result?></h2>
    <p>Humans total score::</p>
    <p><?=$showResultOfHumansLatestRoll?> = <?= $humansTotalScore?></p>

    <?php if ($showResultOfHumansLatestRollGraphiclly) : ?>
        <p>
        <?php foreach ($showResultOfHumansLatestRollGraphiclly as $value) : ?>
            <i class="dice-sprite <?= $value ?>"></i>
        <?php endforeach; ?>
        </p>
    <?php endif;?>

    <?php if ($showResultOfMachinesLatestRoll) : ?>
    <p>Machines total score:</p>

        <p><?=$showResultOfMachinesLatestRoll?> = <?= $machineTotalScore?></p>
    <?php endif;?>
    <?php if ($showResultOfMachinesLatestRollGraphiclly) : ?>
        <p>
        <?php foreach ($showResultOfMachinesLatestRollGraphiclly as $value) : ?>
            <i class="dice-sprite <?= $value ?>"></i>
        <?php endforeach; ?>
        </p>
    <?php endif;?>

    <p>Machines winnings: <?=$machineWins?> round(s)<p>
    <p>Humans winnings: <?=$humanWins?> round(s)<p>

    <form method ="post" action="<?= url("/dice-play-again")?>">
    <input type = "submit" id="submit" name="doit" value = "Play again">
    </form>

    <?php if ($oneMoreTime) : ?>
        <p><?= $oneMoreTime ?></p>
    <?php endif; ?>

    <form method ="post" action="<?= url("/dice-all-reset-score")?>">
    <input type = "submit" id="submit" name="doit" value = "Travel Back">
    </form>

<?php endif;?>
