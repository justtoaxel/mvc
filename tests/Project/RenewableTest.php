<?php
namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class hand.
 */
class RenewableTest extends TestCase
{

    /**
     * Construct object.
     */

     public function testGetId()
     {
        $renewable = new Renewable();
        $this->assertInstanceOf("\App\Entity\Renewable", $renewable);

        $renewableID = $renewable->setId(1);
        $renewableID = $renewable->getId();
        $exp = 1;
         $this->assertEquals($exp, $renewableID);
     }

     public function testSetBiobransle()
     {
        $renewable = new Renewable();
        $this->assertInstanceOf("\App\Entity\Renewable", $renewable);

        $biobransle = $renewable->setBiobransle(500);
        $biobransle = $renewable->getBiobransle();
        $exp = 500;
         $this->assertEquals($exp, $biobransle);
     }

     public function testSetVattenkraft()
     {
        $renewable = new Renewable();
        $this->assertInstanceOf("\App\Entity\Renewable", $renewable);

        $vattekraft = $renewable->setVattenkraft(500);
        $vattekraft = $renewable->getVattenkraft();
        $exp = 500;
         $this->assertEquals($exp, $vattekraft);
     }

     public function testSetVindkraft()
     {
        $renewable = new Renewable();
        $this->assertInstanceOf("\App\Entity\Renewable", $renewable);

        $vindkraft = $renewable->setVindkraft(500);
        $vindkraft = $renewable->getVindkraft();
        $exp = 500;
         $this->assertEquals($exp, $vindkraft);
     }

     public function testSetVarmepumpar()
     {
        $renewable = new Renewable();
        $this->assertInstanceOf("\App\Entity\Renewable", $renewable);

        $varmepumpar = $renewable->setVarmepumpar(500);
        $varmepumpar = $renewable->getVarmepumpar();
        $exp = 500;
         $this->assertEquals($exp, $varmepumpar);
     }

     public function testSetSolenergi()
     {
        $renewable = new Renewable();
        $this->assertInstanceOf("\App\Entity\Renewable", $renewable);

        $solenergi = $renewable->setSolenergi(500);
        $solenergi = $renewable->getSolenergi();
        $exp = 500;
         $this->assertEquals($exp, $solenergi);
     }

     public function testSetTotalgron()
     {
        $renewable = new Renewable();
        $this->assertInstanceOf("\App\Entity\Renewable", $renewable);

        $totalgron = $renewable->setTotalgron(500);
        $totalgron = $renewable->getTotalgron();
        $exp = 500;
         $this->assertEquals($exp, $totalgron);
     }

     public function testSetTotalenergi()
     {
        $renewable = new Renewable();
        $this->assertInstanceOf("\App\Entity\Renewable", $renewable);

        $totalenergi = $renewable->setTotalenergi(500);
        $totalenergi = $renewable->getTotalenergi();
        $exp = 500;
         $this->assertEquals($exp, $totalenergi);
     }

}