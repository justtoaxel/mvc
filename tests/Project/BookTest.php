<?php
namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class hand.
 */
class BookTest extends TestCase
{

    /**
     * Construct object.
     */

     public function testGetId()
     {
        $book = new Book();
        $this->assertInstanceOf("\App\Entity\Book", $book);

        $books = $book->getId();
        $exp = null;
         $this->assertEquals($exp, $books);
     }

     public function testSetName()
     {
        $book = new Book();
        $this->assertInstanceOf("\App\Entity\Book", $book);

        $books = $book->setName('500');
        $books = $book->getName();
        $exp = '500';
         $this->assertEquals($exp, $books);
     }

     public function testSetAuthor()
     {
        $book = new Book();
        $this->assertInstanceOf("\App\Entity\Book", $book);

        $books = $book->setAuthor('Test');
        $books = $book->getAuthor();
        $exp = 'Test';
         $this->assertEquals($exp, $books);
     }

     public function testSetIsbn()
     {
        $book = new Book();
        $this->assertInstanceOf("\App\Entity\Book", $book);

        $books = $book->setIsbn(500);
        $books = $book->getIsbn();
        $exp = 500;
         $this->assertEquals($exp, $books);
     }

     public function testSetImage()
     {
        $book = new Book();
        $this->assertInstanceOf("\App\Entity\Book", $book);

        $books = $book->setImg('Test');
        $books = $book->getImg();
        $exp = 'Test';
         $this->assertEquals($exp, $books);
     }

}