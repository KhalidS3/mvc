<?php

declare(strict_types=1);

namespace KhalidS3\Dice;

/**
 * class DiceHandGraphic
 * Representation of dice hand with an image(s)
 */
class DiceHandGraphic extends DiceHand
{
    /**
     * @var array $diceGraphics[]     Array consisting of dice imgaes.
     * @var array $diceHistoryGraphic[] Array consisting of dice history image.
     */
    private array $diceGraphic;
    private array $showAllDiceGraphics;

    /**
     * Constructor to initiate the Dice image with a number of dice sides.
     *
     * @param int $diceSides Number of dice sides to create with default value 1.
     *
     * @return void
     */
    public function __construct(int $diceSides = 1)
    {
        for ($i = 0; $i < $diceSides; $i++) {
            $this->dices[$i] = new DiceGraphic();
        }
    }

    /**
     * @return array $diceGraphics[] Stores dice data and
     * shows dice image corresponding with dice data
     */
    public function showDiceHandGraph(): array
    {
        $len = count($this->dices);
        for ($i = 0; $i < $len; $i++) {
            $this->diceGraphic[$i] = $this->dices[$i]->diceGraphic();
            $this->showAllDiceGraphics[] = $this->dices[$i]->diceGraphic();
        }

        return $this->diceGraphic;
    }

    /**
     * @return array Array consisting of all rolled dice with images
     */
    public function showAllRolledDiceGraph(): array
    {
        return $this->showAllDiceGraphics;
    }
}
