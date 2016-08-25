<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\GuestBook;

class GuestBookTest extends \PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $guestBook = new GuestBook();
        $guestBook = $guestBook->setName('John Doe');
        $this->assertTrue($guestBook instanceof GuestBook);
        $this->assertEquals('John Doe', $guestBook->getName());
        unset($guestBook);
    }

    public function testComment()
    {
        $guestBook = new GuestBook();
        $guestBook = $guestBook->setComment('This is a comment');
        $this->assertTrue($guestBook instanceof GuestBook);
        $this->assertEquals('This is a comment',$guestBook->getComment());
        unset($guestBook);
    }

    public function testEntity()
    {
        $this->assertClassHasAttribute('name',GuestBook::class);
        $this->assertClassHasAttribute('comment',GuestBook::class);
    }
}