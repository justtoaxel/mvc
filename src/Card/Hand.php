<?php

namespace App\Card;

use App\Card\Card;

class Hand
{
    private $hand = [];

    public function add(String $card): void
    {
        $this->hand[] = $card;
    }

    public function getHand(): array
    {

        return $this->hand;

    }

}
