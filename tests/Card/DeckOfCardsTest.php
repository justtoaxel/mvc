<?php
namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DeckOfCards.
 */
class DeckOfCardsTest extends TestCase
{

    /**
     * Construct object.
     */

     public function testThatCardsAreAdded()
     {
         
         $deck = new DeckOfCards();
         $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);
 
         for ($i = 1; $i <= 52; $i++) {
            $card = new CardGraphic();
            $cardString = $card->getAsRepresentation($i);
            $deck->addCard($cardString);
        }
 
         $deckOfCards = $deck->getDeckOfCards();
 
         $this->assertArrayHasKey(5, $deckOfCards);
         $this->assertContains('🂴', $deckOfCards);
     }

    public function testThatCreatesValue()
    {

        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);

        for ($i = 1; $i <= 52; $i++) {
            $card = new CardGraphic();
            $cardString = $card->getAsRepresentation($i);
            $deck->addCard($cardString);
        }

        $deck->makeValueDeck();
        $deckOfCards = $deck->getDeckOfCards();
        

        $this->assertArrayHasKey('🂱', $deckOfCards);
    }

    public function testThatItDrawsCard()
    {

        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);

        for ($i = 1; $i <= 52; $i++) {
            $card = new CardGraphic();
            $cardString = $card->getAsRepresentation($i);
            $deck->addCard($cardString);
        }

        $deck->makeValueDeck();
        $deckOfCards = $deck->getDeckOfCards();
        $deckOfCards = $deck->drawCard(1);
        

        $this->assertCount(51, $deckOfCards);
    }

    public function testThatItGetsDrawn()
    {

        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);

        for ($i = 1; $i <= 52; $i++) {
            $card = new CardGraphic();
            $cardString = $card->getAsRepresentation($i);
            $deck->addCard($cardString);
        }

        $deck->makeValueDeck();
        $deckOfCards = $deck->getDeckOfCards();
        $deckOfCards = $deck->drawCard(1);
        $deckOfCards = $deck->drawnCards();

        $this->assertCount(1, $deckOfCards);
    }

    public function testThatCanGetNumber()
    {

        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);

        for ($i = 1; $i <= 52; $i++) {
            $card = new CardGraphic();
            $cardString = $card->getAsRepresentation($i);
            $deck->addCard($cardString);
        }

        $deck->makeValueDeck();
        $deckOfCards = $deck->getDeckOfCards();
        $deckOfCards = $deck->drawCard(1);
        $deckOfCards = $deck->getNumberCards();

        $this->assertEquals(51, $deckOfCards);
    }
}