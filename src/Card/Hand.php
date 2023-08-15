<?php

namespace App\Card;

use App\Card\Card;

class Hand
{
    private $hand = [];

    public function addCards(array $cards): void
    {
        $this->hand;
        $this->hand = $cards;
    }

    public function getHand(): array
    {
        return $this->hand;
    }

    public function getSum(): int
    {
        return $sumHand = array_sum($this->hand);
    }

    public function valueHand(): array
    {
        return $this->hand;
    }

}
