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

    public function addCards(array $cards): void
    {
        $addedCards = array_replace($this->bank, $cards);
        //print_r($addedCards);
        $this->bank = $addedCards;
    }

    public function getBank(): array
    {
        return $this->bank;
    }

    public function getSum(): int
    {
        return $sumBank = array_sum($this->bank);
    }

}
