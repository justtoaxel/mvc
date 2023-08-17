<?php
namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class bank.
 */
class BankTest extends TestCase
{

    /**
     * Construct object.
     */

     public function test_bank_gets_cards()
     {
        $values = [
            '🂱'=> 1,
            '🂲'=> 2,
            '🂳'=> 3,
        ];
         $bank = new BankHand();
         $this->assertInstanceOf("\App\Card\BankHand", $bank);

         $bankCards = $bank->setbank($values);
         $bankCards = $bank->getbank();
 
         $this->assertArrayHasKey('🂲', $bankCards);
     }

     public function test_bank_add_cards()
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

         $bank = new BankHand();
         $this->assertInstanceOf("\App\Card\BankHand", $bank);

         $bankCards = $bank->setbank($arr1);
         $bankCards = $bank->addCards($arr2);
         $bankCards = $bank->getbank();
 
         $this->assertEquals($exp, $bankCards);
     }

     public function test_bank_sum_cards()
     {
        $values = [
            '🂱'=> 1,
            '🂲'=> 2,
            '🂳'=> 3
        ];
         $bank = new BankHand();
         $this->assertInstanceOf("\App\Card\BankHand", $bank);

         $bankCards = $bank->setBank($values);
         $bankCards = $bank->getSum();
 
         $this->assertEquals(6, $bankCards);
     }

}