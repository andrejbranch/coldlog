<?php

namespace ColdLog\Bundle\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testHome()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals($client->getResponse()->getStatusCode(), 200);
    }
}
