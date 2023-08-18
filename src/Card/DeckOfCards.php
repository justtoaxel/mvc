<?php

namespace App\Card;

class DeckOfCards
{
    private $deck = [];
    private $hand = [];
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

    public function makeValueDeck(): array
    {
        $arr1 = array_flip($this->deck);
        $values = (array_replace($arr1, $this->values));
        //print_r(count($remainingDeck));
        //print_r(count($values));
        //array_diff_key($arr1, $this->values);
        //print_r($test);

        return $this->deck = $values;
    }

    public function drawCard(int $drawAmount): array
    {
        //Remove cards from Deck, graphics
        //print_r($this->deck);
        $remainingDeck = array_splice($this->deck, $drawAmount);
        //returns value of array above, also removes top 2 cards
        //$arr1 = array_flip($this->deck);
        //$values = (array_replace($arr1, $this->values));
        $this->hand = $this->deck;
        //print_r($this->deck);
        return $this->deck = $remainingDeck;
    }


    //Gets the graphic representation in the Array
    public function getValueCards(array $cards): array
    {
        return array_keys($cards);
    }

    public function drawnCards(): array
    {

        return $this->hand;
    }

    public function getNumberCards(): int
    {
        return count($this->deck);
    }

}
