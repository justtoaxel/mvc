<?php

namespace App\Card;

use App\Card\Card;

class Hand
{
    private $hand = [];

    public function setHand(array $cardHand): array
    {
        return $this->hand = $cardHand;
    }

    public function addCards(array $cards): void
    {
        $addedCards = array_replace($this->hand, $cards);
        //print_r($addedCards);
        $this->hand = $addedCards;
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
