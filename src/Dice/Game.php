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
 * class Game
 */
class Game
{
    /**
     * @var array $datas[]
     * @var string $gameStatus        Games situation and progress.
     * @var object $playersHand       Object for players hand.
     * @var object $machinesHand       Object for computer/machine hand.
     * @var int    $playersTotalScore To save in players total score.
     * @var int    $machineTotalScore To save in machines/computers total score.
     * @var int    $playerWins        To save players number of wins.
     * @var int    $machineWins       To save machines/computers numbers of wins.
     *
     * setting class attributes to private
     */
    private array $data = [
        "header" => "Game21",
        "message" => "Humans VS Machines"
    ];
    private string $gameStatus = "";
    private ?object $playersHand = null;
    private ?object $machinesHand = null;
    private int $playersTotalScore = 0;
    private int $machineTotalScore = 0;
    private int $playerWins = 0;
    private int $machineWins = 0;
}
