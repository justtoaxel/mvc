<?php

namespace App\Card;

use App\Card\Card;

class BankHand
{
    private $bank = [];

    public function setBank(array $cardBank): array
    {
        return $this->bank = $cardBank;
    }

    public function addCards(array $cards): array
    {
        $addedCards = array_replace($this->bank, $cards);
        //print_r($addedCards);
        return $this->bank = $addedCards;
    }

    public function getBank(): array
    {
        return $this->bank;
    }

    public function getSum(): int
    {
        return array_sum($this->bank);
    }

}
