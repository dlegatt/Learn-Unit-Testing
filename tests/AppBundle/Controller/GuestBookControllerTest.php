<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GuestBookControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET','/guestbook');
        $result = json_decode($client->getResponse()->getContent(),true);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(3,count($result));
        for ($i=0;$i<3;$i++) {
            $this->assertArrayHasKey('name',$result[$i]);
            $this->assertArrayHasKey('comment',$result[$i]);
        }
    }

    public function testNew()
    {
        $name = 'Tina Belcher';
        $comment = 'If you need me, I\'ll be down here on the floor. Dying.';
        $data = json_encode([
            'name' => $name,
            'comment' => $comment
        ]);
        $client = static::createClient();
        $client->request('POST','/guestbook/new',[],[],[],$data);
        $data = json_decode($client->getResponse()->getContent(),true);
        $this->assertEquals(201,$client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('entry',$data);
        $this->assertEquals(3,count($data['entry']));
        $this->assertArrayHasKey('name',$data['entry']);
        $this->assertArrayHasKey('comment',$data['entry']);
        $this->assertEquals($name,$data['entry']['name']);
        $this->assertEquals($comment,$data['entry']['comment']);
        $this->assertEquals(4,$data['entry']['id']);
    }

    public function testView()
    {
        $name = 'Bob Belcher';
        $comment = 'This place should serve burgers';
        $id = 1;
        $client = static::createClient();
        $client->request('GET','/guestbook/'.$id);
        $data = json_decode($client->getResponse()->getContent(),true);
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('entry',$data);
        $this->assertEquals(3,count($data['entry']));
        $this->assertArrayHasKey('name',$data['entry']);
        $this->assertArrayHasKey('comment',$data['entry']);
        $this->assertArrayHasKey('id',$data['entry']);
        $this->assertEquals($name,$data['entry']['name']);
        $this->assertEquals($comment,$data['entry']['comment']);
        $this->assertEquals($id,$data['entry']['id']);
    }
}