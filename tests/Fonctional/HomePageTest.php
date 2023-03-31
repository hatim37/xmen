<?php

namespace App\Tests\Fonctional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomePageTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $button = $crawler->filter('.btn.btn-success.btn-size');
        $this->assertEquals(6, count($button));

        $table = $crawler->filter('.table-responsive');
        $this->assertEquals(1, count($table));

        $this->assertSelectorTextContains('h1', 'Bienvenue chez les X-Men');
    }
}
