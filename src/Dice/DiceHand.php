<?php

declare(strict_types=1);

namespace KhalidS3\Dice;

/**
 * Class DiceHand
 */
class DiceHand
{
    /**
     * @var array $dice[]       Array consisting of dices.
     * @var array $result[]     Array consisting of results
     * @var array $gameHistor[] Array consisting of games history
     * @var int   $diceSum The sum of rolled dices.
     */
    protected array $dices = [];
    protected array $results = [];
    protected array $gameHistory = [];
    protected ?int $diceSum = 0;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $diceSides Number of dice sides.
     * @param int $numOfDices Number of dices to create.
     */
    public function __construct(int $numOfDices = 1, int $diceSides = 6)
    {
        for ($i = 0; $i < $numOfDices; $i++) {
            $this->dices[$i] = new Dice($diceSides);
        }
    }

    /**
     * Roll all dices save their value.
     *
     * @return array $result[] Array consisting of rolled dice results
     */
    public function roll(): array
    {
        $len = count($this->dices);
        for ($i = 0; $i < $len; $i++) {
            $this->dices[$i]->roll();
            $this->results[$i] = $this->dices[$i]->getLastRoll();
            $this->gameHistory[] = $this->dices[$i]->getLastRoll();
        }

        return $this->results;
    }

    /**
     * Get result of dices from last roll.
     *
     * @return array with result of the last roll.
     */
    public function getLastRoll(): array
    {
        $len = count($this->dices);
        for ($i = 0; $i < $len; $i++) {
            $this->results[] = $this->dices[$i]->getLastRoll();
        }

        return $this->results;
    }

    /**
     * Adds latest roll of dices
     *
     * @return void
     */
    public function totalSumOfLatestDices(): void
    {
        $len = count($this->dices);
        $this->diceSum = 0;

        for ($i = 0; $i < $len; $i++) {
            $this->diceSum += $this->dices[$i]->getLastRoll();
        }
    }

    /**
     * @return int $diceSum The total sum of latest rolled dice.
     */
    public function getTotalSumOfRolledDice(): int
    {
        return $this->diceSum;
    }

    /**
     * @return string Returns dice results/values comma separated
     */
    public function showResultOfLatestRoll(): string
    {
        $str = implode(", ", $this->results);

        return $str;
    }

    /**
     * @return string Returns games history, wins and loses
     */
    public function showHistory()
    {
        $str = implode(", ", $this->gameHistory);

        return $str;
    }
}
