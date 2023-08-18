<?php

/**
 * Jag väljer att göra en DockBlock på denna klass då detta  är den klass som har liknande metoder till de andra klasserna.
 */

namespace App\Card;

use App\Card\Card;

class Hand
{
    private $hand = [];

    /**
     * Denna "sparar" ner inmatad Kort-array från routen så att den kan användas för att manipuleras av de andra metoderna.
     */
    public function setHand(array $cardHand): array
    {
        return $this->hand = $cardHand;
    }

    /**
    * Denna klass lägger till en ny Kort-array tillsammans med den tidigare och på så sätt ökar antalet kort i handen, den sparar sedan ner denna till hand-arrayen.
    */
    public function addCards(array $cards): array
    {
        $addedCards = array_replace($this->hand, $cards);
        //print_r($addedCards);
        return $this->hand = $addedCards;
    }
    /**
    * Denna metod används helt enkelt för att få ut handleken som en array, och på så sätt kunna till exempel spara den i Sessionen via routen
    */
    public function getHand(): array
    {
        return $this->hand;
    }
    /**
    * Denna metod beräknar summan av alla värden i handen, och det är den som används för att kolla att korten inte överstiger 21 och jämför även med bankens-hand.
    */
    public function getSum(): int
    {
        return array_sum($this->hand);
    }

}
