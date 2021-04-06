<?php

declare(strict_types=1);

namespace KhalidS3\Dice;

use function Mos\Functions\{
    redirectTo,
    renderView,
    sendResponse,
    url
};

// use KhalidS3\Dice\Dice;
// use KhalidS3\Dice\DiceHand;
use KhalidS3\Dice\{
    Dice,
    DiceHand
};

/**
 * Class Dice.
 */
class Game
{
    public function playGame(): void
    {
        $data = [
            "header" => "Dice",
            "message" => "Rolling the dice",
        ];

        $die = new Dice(6);
        $die->roll();

        $diceHand = new DiceHand();
        $diceHand->roll();

        $data["dieLastRoll"] = $die->getLastRoll();
        $data["diceHandRoll"] = $diceHand->getLastRoll();

        $diceHand->roll();
        $data["diceHandRoll1"] = $diceHand->getLastRoll();

        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }
}
