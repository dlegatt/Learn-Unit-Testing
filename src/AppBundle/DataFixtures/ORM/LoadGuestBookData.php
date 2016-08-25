<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\GuestBook;

class LoadGuestBookData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $data = [
            [
                'name' => 'Bob Belcher',
                'comment' => 'This place should serve burgers'
            ],
            [
                'name' => 'Linda Belcher',
                'comment' => 'Awwww, Bobby!'
            ],
            [
                'name' => 'Tina Belcher',
                'comment' => 'BUUUUUUUUUUUUTTS'
            ]
        ];

        foreach ($data as $entry) {
            $guestBook = new GuestBook();
            $guestBook
                ->setName($entry['name'])
                ->setComment($entry['comment']);
            $manager->persist($guestBook);
        }
        $manager->flush();
    }
}