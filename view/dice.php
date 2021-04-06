<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use KhalidS3\Dice\Dice;
use KhalidS3\Dice\DiceHand;


$header = $header ?? null;
$message = $message ?? null;

$die = new Dice();
$die->roll();

$diceHand = new DiceHand();
$diceHand->roll();

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<p>DICE!!!!</p>

<p><?= $die->getLastRoll() ?></p>

<p>DiceHand</p>

<p><?= $diceHand->getLastRoll() ?></p>
