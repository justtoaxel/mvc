<?php
namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class card.
 */
class CardTest extends TestCase
{

    /**
     * Card kan inte testas mer än detta då det är ett objekt som är del av andra klasser. Den testas istället via metodern i de andra klasserna
     */

     public function test_card()
     {
        $card = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card);
     }

}