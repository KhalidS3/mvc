<?php

declare(strict_types=1);

namespace KhalidS3\Dice;

use KhalidS3\Dice\{
    Dice,
    DiceHand,
    DiceGraphic,
    DiceHandGraphic
};

use function Mos\Functions\{
    redirectTo,
    renderView,
    sendResponse,
    url
};

/**
 * Class Game
 */
class Game
{
    /**
     * @var string $gameStatus        Games situation and progress.
     * @var object $humansHand       Object for humans hand.
     * @var object $machinesHand       Object for computer/machine hand.
     * @var int    $humansTotalScore To save in humans total score.
     * @var int    $machineTotalScore To save in machines/computers total score.
     * @var int    $humanWins        To save humans number of wins.
     * @var int    $machineWins       To save machines/computers numbers of wins.
     *@var array   $datas[]
     * setting class attributes to private
     */
    private string $gameStatus = "";
    private string $diceType = "";
    private ?object $humansHand = null;
    private ?object $machinesHand = null;
    private int $humansTotalScore = 0;
    private int $machineTotalScore = 0;
    private int $humanWins = 0;
    private int $machineWins = 0;
    private array $data;

    /**
     * Constructor
     *
     */
    public function __construct()
    {
         // save gameStatus in session
        $_SESSION["isRunning"] = $this;

        //Setting the gamestatus to setupDiceBoard
        $this->gameStatus = "setupDiceBoard";

        $this->data = [
            "title" => "Dice 21",
            "header" => "Dice 21",
            "message" => "Humans VS Machines",
        ];
    }

    /**
     * To start and setup dice board game
     *
     * @param int $numOfDices To choice between 1 or 2 dices to play
     * @param string $diceType TO choose between type of dice
     *
     * @return void
     */
    public function setupDiceBoard(int $numOfDice, string $diceType): void
    {
        $this->diceType = $diceType;
        // 1. Check human and machine has choosen graphical dice
        if ($this->diceType === "graphical") {
            $this->humansHand = new DiceHandGraphic($numOfDice);
            $this->machinesHand = new DiceHandGraphic($numOfDice);
        }

        // 2. Setting the humans hand, dice graphically to null
        $this->data["humanRoll"] = null;
        $this->data["sumOfHumanRoll"] = null;
        $this->data["humansTotalScore"] = null;
        $this->data["showHumansGraphicalDice"] = null;
        $this->data["showResultOfHumansLatestRoll"] = null;
        $this->data["showResultOfHumansLatestRollGraphiclly"] = null;

        // 3. Setting the machine shand, dice graphically to null
        $this->data["machineRoll"] = null;
        $this->data["sumOfMachineRoll"] = null;
        $this->data["machineTotalScore"] = null;
        $this->data["showMachinesGraphicalDice"] = null;
        $this->data["showResultOfMachinesLatestRoll"] = null;
        $this->data["showResultOfMachinesLatestRollGraphiclly"] = null;

        // 4. Setting the winning number(21) to null too
        $this->data["winningNumber"] = null;

        // 5. Human gets to play first
        $this->gameStatus = "humanTurn";
    }
    /**
     * Humans turn to roll dice
     *
     * @return void
     */
    public function humanRoll(): void
    {
        // 1. starts with dice roll first
        $this->humansHand->roll();
        // var_dump($this->humansHand->roll());

        // 2. to show humansHand latest rolled dices
        $this->data["humanRoll"] = $this->humansHand->showResultOfLatestRoll();

        // 3. to show all rolled dice results
        $this->data["showResultOfHumansLatestRoll"] = $this->humansHand->showHistory();

        //4. Add all rolled dice
        $this->humansHand->totalSumOfLatestDices();

        // 5. After summing all dices assign/save it to humanSum in data, increase dice value
        // with sum
        $this->data["sumOfHumanRoll"] = $this->humansHand->getTotalSumOfRolledDice();
        $this->humansTotalScore += $this->humansHand->getTotalSumOfRolledDice();

        // 6. After that save humans total sum in data, to see if won or lost
        $this->data["humansTotalScore"] = $this->humansTotalScore;

        // 7. If diceType graphically show dice graphically
        if ($this->diceType === "graphical") {
            $this->data["showHumansGraphicalDice"] = $this->humansHand->showDiceHandGraph();
            $this->data["showResultOfHumansLatestRollGraphiclly"] = $this->humansHand->showAllRolledDiceGraph();
        }

        // 8. check if its the winningNum, if humansTotalScore is 21
        // declare human winner
        if ($this->humansTotalScore === 21) {
            $this->data["winningNumber"] = "You got the ultimate number 21!";
        }
        // 9. declare lost if humanTotalScore is bellow total 21
        if ($this->humansTotalScore > 21) {
            //Setting the gameStatus to gameOver
            $this->gameStatus = "gameOver";
            // Showing result message from the machines
            $this->data["result"] = "You got terminated, machine won!";
            //Increaseing machineWins
            $this->machineWins++;
            // record human and machines winnings and loses
            $this->data["machineWins"] = $this->machineWins;
            $this->data["humanWins"] = $this->humanWins;

            // Human can choose to go back in time and
            // until human succeeds
            $this->oneMoreTime();
        }
    }

    /**
     * Machines turn to roll dice
     *
     * @return void
     */
    public function machineRoll(): void
    {
        // 1. loop until machines wins or loses
        while ($this->machineTotalScore < $this->humansTotalScore && $this->machineTotalScore <= 21) {
            // 1. starts with dice roll first
            $this->machinesHand->roll();
            // 2. to show machinesHand latest rolled dices
            $this->data["machineRoll"] = $this->machinesHand->showResultOfLatestRoll();

            // 3. to show all rolled dice results
            $this->data["showResultOfMachinesLatestRoll"] = $this->machinesHand->showHistory();

            // 4. Add all rolled dice
            $this->machinesHand->totalSumOfLatestDices();

             // 5. After summing all dices assign/save it to machinesum in data, increase dice value
            // with sum
            $this->data["sumOfMachineRoll"] = $this->machinesHand->getTotalSumOfRolledDice();
            $this->machineTotalScore += $this->machinesHand->getTotalSumOfRolledDice();

            // 6. After that save machines total sum in data, to see if won or lost
            $this->data["machineTotalScore"] = $this->machineTotalScore;

            // 7. If diceType graphically show dice graphically
            if ($this->diceType === "graphical") {
                $this->data["showMachinesGraphicalDice"] = $this->machinesHand->showDiceHandGraph();
                $this->data["showResultOfMachinesLatestRollGraphiclly"] = $this->machinesHand->showAllRolledDiceGraph();
            }

        // 2. setting game status to machines turn
            $this->gameStatus = "machineTurn";
        }

       // 3. check if its winningNUm(21), if machinesTotalScore is 21
       // declare machines winner, else declare lost
        if ($this->machineTotalScore <= 21 && $this->machineTotalScore >= $this->humansTotalScore) {
            $this->data["result"] = "You got terminated, machine won!";
            $this->machineWins++;
        } else if ($this->machineTotalScore > 21 || $this->machineTotalScore < $this->humansTotalScore) {
            $this->data["result"] = "Machine got terminated, human won!";
            $this->humanWins++;
        }

        $this->data["machineWins"] = $this->machineWins;
        $this->data["humanWins"] = $this->humanWins;

        // Machine can choose to go back in time and
        // until machine succeeds
        $this->oneMoreTime();

        //Set gameStatus to gameOver
        $this->gameStatus = "gameOver";
    }

    /**
     * Setting all to null
     * @return void
     */
    public function playAgain(): void
    {
        // Resetting
        $this->gameStatus = "setupDiceBoard";
        $this->diceType = "";
        $this->humansHand = null;
        $this->machinesHand = null;
        $this->humansTotalScore = 0;
        $this->machineTotalScore = 0;
        $this->data = [
            "title" => "Dice 21",
            "header" => "Dice 21",
            "message" => "Human VS Machine",
        ];
    }

    /**
     * winning lower than 5 traval back in time
     */
    public function oneMoreTime(): void
    {
        //Set oneMoreTime to null
        $this->data["oneMoreTime"] = null;

        //Check if someones bitcoin is below 0 and set data
        if ($this->HumanWins <= 5) {
            $this->data["oneMoreTime"] = "Human uses Time Travel machine to reset score";
        } elseif ($this->machineWins >= 5) {
            $this->data["oneMoreTime"] = "Machine uses Time Travel machine to reset score";
        }
    }

    /**
     * Resets the score (won rounds)
     * @return void
     */
    public function resetAllScore(): void
    {
        //Reset member variables
        $this->humanWins = 0;
        $this->machineWins = 0;
        $this->data["machineWins"] = $this->machineWins;
        $this->data["humanWins"] = $this->humanWins;
    }

    /**
     * Plays (renders the game)
     * @return void
     */
    public function playGame(): void
    {
        $this->data["gameStatus"] = $this->gameStatus;

        $body = renderView("layout/dice.php", $this->data);
        sendResponse($body);
    }
}
