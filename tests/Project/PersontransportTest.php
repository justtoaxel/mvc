<?php
namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class hand.
 */
class PersontransportTest extends TestCase
{

    /**
     * Construct object.
     */

     public function testGetId()
     {
        $transport = new Persontransport();
        $this->assertInstanceOf("\App\Entity\Persontransport", $transport);

        $vagtrafik = $transport->getId();
        $exp = null;
         $this->assertEquals($exp, $vagtrafik);
     }

     public function testSetVagtrafik()
     {
        $transport = new Persontransport();
        $this->assertInstanceOf("\App\Entity\Persontransport", $transport);

        $vagtrafik = $transport->setVagtrafik(1250);
        $vagtrafik = $transport->getVagtrafik();
        $exp = 1250;
         $this->assertEquals($exp, $vagtrafik);
     }

     public function testSetBantrafik()
     {
        $transport = new Persontransport();
        $this->assertInstanceOf("\App\Entity\Persontransport", $transport);

        $bantrafik = $transport->setBantrafik(1250);
        $bantrafik = $transport->getBantrafik();
        $exp = 1250;
         $this->assertEquals($exp, $bantrafik);
     }
     
     public function testSetSjofart()
     {
        $transport = new Persontransport();
        $this->assertInstanceOf("\App\Entity\Persontransport", $transport);

        $sjofart = $transport->setSjofart(1250);
        $sjofart = $transport->getSjofart();
        $exp = 1250;
         $this->assertEquals($exp, $sjofart);
     }

     public function testSetLuftfart()
     {
        $transport = new Persontransport();
        $this->assertInstanceOf("\App\Entity\Persontransport", $transport);

        $luftfart = $transport->setLuftfart(1250);
        $luftfart = $transport->getLuftfart();
        $exp = 1250;
         $this->assertEquals($exp, $luftfart);
     }

}