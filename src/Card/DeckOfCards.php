<?php

namespace App\Card;

class DeckOfCards
{
    private $deck = [];
    private $values = [
        '🂱'=> 1,
        '🂲'=> 2,
        '🂳'=> 3,
        '🂴'=> 4,
        '🂵'=> 5,
        '🂶'=> 6,
        '🂷'=> 7,
        '🂸'=> 8,
        '🂹'=> 9,
        '🂺'=> 10,
        '🂻'=> 11,
        '🂽'=> 12,
        '🂾'=> 13,
        '🃁'=> 1,
        '🃂'=> 2,
        '🃃'=> 3, 
        '🃄'=> 4,
        '🃅'=> 5,
        '🃆'=> 6,
        '🃇'=> 7,
        '🃈'=> 8,
        '🃉'=> 9,
        '🃊'=> 10,
        '🃋'=> 11,
        '🃍'=> 12,
        '🃎'=> 13,
        '🃑'=> 1,
        '🃒'=> 2,
        '🃓'=> 3,
        '🃔'=> 4,
        '🃕'=> 5,
        '🃖'=> 6,
        '🃗'=> 7,
        '🃘'=> 8,
        '🃙'=> 9,
        '🃚'=> 10,
        '🃛'=> 11,
        '🃝'=> 12,
        '🃞'=> 13,
        '🂡'=> 1,
        '🂢'=> 2,
        '🂣'=> 3,
        '🂤'=> 4,
        '🂥'=> 5,
        '🂦'=> 6,
        '🂧'=> 7,
        '🂨'=> 8,
        '🂩'=> 9,
        '🂪'=> 10,
        '🂫'=> 11,
        '🂭'=> 12,
        '🂮'=> 13,
    ];

    public function addCard(string $card): void
    {
        $this->deck[] = $card;
    }

    public function getDeckOfCards(): array
    {
        return $this->deck;
    }

    public function shuffleDeck(): array
    {
        shuffle($this->deck);
        return $this->deck;
    }

    public function getValueDeck(): array
    {
        $arr1 = array_flip($this->deck);
        $values = (array_replace($arr1, $this->values));
        return $this->deck = $values;
    }

    public function drawCard(int $drawAmount): array
    {

        $remainingDeck = array_splice($this->deck, $drawAmount);
        return $remainingDeck;
    }

    public function getNumberCards(): int
    {
        return count($this->deck);
    }

}
