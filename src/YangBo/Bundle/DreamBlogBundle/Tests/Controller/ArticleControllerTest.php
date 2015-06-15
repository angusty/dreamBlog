<?php
namespace YangBo\Bundle\DreamBlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testShow()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/show/1.html');
        $this->assertGreaterThan(0, $crawler->filter('html:contains("亚")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("德赫亚")')->count());
    }
}