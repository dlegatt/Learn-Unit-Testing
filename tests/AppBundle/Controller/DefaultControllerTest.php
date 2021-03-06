<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET','/');

        $result = json_decode($client->getResponse()->getContent(),true);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('message',$result);
        $this->assertEquals('Welcome to Symfony!',$result['message']);
    }
}
