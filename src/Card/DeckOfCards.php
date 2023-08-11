<?php

namespace App\Card;

class DeckOfCards
{
    private $deck = [];

    public function addCard(string $card): void
    {
        $this->deck[] = $card;
    }

    public function getDeckOfCards(): array
    {
        return $this->deck;
    }

    public function getNumberCards(): int
    {
        return count($this->deck);
    }


}
