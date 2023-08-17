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

     public function test_that_cards_are_added()
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

    public function test_that_creates_value()
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

    public function test_that_it_draws_card()
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

    public function test_that_it_gets_drawn()
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

    public function test_that_can_get_number()
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