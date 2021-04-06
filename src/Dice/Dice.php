<?php

declare(strict_types=1);

namespace KhalidS3\Dice;

/**
 * Class Dice
 */
class Dice
{
    /**
     * @var int $diceSides  number of dice sides.
     * @var int $latestRoll Value of latest rolled dice.
     */
    // const FACES = 6;
    private ?int $diceSides;
    protected ?int $latestRoll = null;

    /**
     * Constructor to initiate the Dice with a number of dice sides.
     *
     * @param int $diceSides Number of dice sides to create.
     *
     * @return void
     */
    public function __construct(int $diceSides = 6)
    {
        $this->diceSides = $diceSides;
    }

    /**
     * Rolling the the dice to get the random numbers.
     *
     * @return int The total number of rolled dice(s).
     */
    public function roll(): int
    {
        return $this->latestRoll = rand(1, $this->diceSides);
    }

    /**
     * @return int Gets/returns last rolled values of dice
     *
     * @return integer
     */
    public function getLastRoll(): int
    {
        return $this->latestRoll;
    }
}
