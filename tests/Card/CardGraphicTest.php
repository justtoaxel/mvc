<?php
namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class card.
 */
class CardGraphicTest extends TestCase
{

    /**
     * Construct object.
     */

     public function test_card()
     {
        $card = new CardGraphic();
        $this->assertInstanceOf("\App\Card\CardGraphic", $card);

        $cardRep = $card->getAsRepresentation(5);
        $this->assertEquals('🂵', $cardRep);
     }

}