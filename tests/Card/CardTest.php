<?php
namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class card.
 */
class CardTest extends TestCase
{

    /**
     * Construct object.
     */

     public function test_card()
     {
        $card = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card);
 
        $exp = null;
        $this->assertEquals($exp, $card);
     }

}