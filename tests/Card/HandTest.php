<?php
namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class hand.
 */
class HandTest extends TestCase
{

    /**
     * Construct object.
     */

     public function test_hand_gets_cards()
     {
        $values = [
            '🂱'=> 1,
            '🂲'=> 2,
            '🂳'=> 3,
        ];
         $hand = new Hand();
         $this->assertInstanceOf("\App\Card\Hand", $hand);

         $handCards = $hand->setHand($values);
         $handCards = $hand->getHand();
 
         $this->assertArrayHasKey('🂲', $handCards);
     }

     public function test_hand_add_cards()
     {
        $arr1 = [
            '🂱'=> 1,
            '🂲'=> 2,
            '🂳'=> 3,
        ];

        $arr2 = [
            '🃞'=> 4,
        ];

        $exp = [
            '🂱'=> 1,
            '🂲'=> 2,
            '🂳'=> 3,
            '🃞'=> 4,
        ];

         $hand = new Hand();
         $this->assertInstanceOf("\App\Card\Hand", $hand);

         $handCards = $hand->setHand($arr1);
         $handCards = $hand->addCards($arr2);
         $handCards = $hand->getHand();
 
         $this->assertEquals($exp, $handCards);
     }

     public function test_hand_sum_cards()
     {
        $values = [
            '🂱'=> 1,
            '🂲'=> 2,
            '🂳'=> 3
        ];
         $hand = new Hand();
         $this->assertInstanceOf("\App\Card\Hand", $hand);

         $handCards = $hand->setHand($values);
         $handCards = $hand->getSum();
 
         $this->assertEquals(6, $handCards);
     }

}