<?php

declare(strict_types=1);

namespace KhalidS3\Dice;

/**
 * class DiceGraphic
 * Representation of a dice with an image
 */
class DiceGraphic extends Dice
{
    const FACES = 6;

    /**
     * Constructor to initiate the Dice with its imgae.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(self::FACES);
    }

    /**
     * Get a graphic value of the last rolled dice.
     *
     * @return string as graphical representation of last rolled dice.
     */
    public function diceGraphic(): string
    {
        return "dice-" . $this->latestRoll;
    }
}
