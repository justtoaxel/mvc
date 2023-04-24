<?php
namespace App\card;

class Deck
{
    private $deck;
    private $suits  = ['♠', '♥', '♦', '♣'];
    private $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
	
    
    public function __construct($deck =[])
    {
        foreach ($this->suits as $suit) {
            if ($suit == "♥;" || $suit == "♦;") {
            $color = "red";
            } else {
            $color = "black";
            }
			foreach ($this->values as $value) {
				$this->deck[] = $value . $suit;
			}
		}
	}

    public function getDeck(): array
    {
        return $this->deck;
    }

    public function getAsString(): string
    {
        $this->deck;
        return this->deck;
    }
  
/*
    public function getDeck(): int
    {
        for ($deckNum = 1; $deckNum <= 52; $deckNum++) {
          }
        return $this->deckNum;
    }
    */

}