<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlogControllerTest extends WebTestCase
{
    public function testPost(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/post');

        $buttonCrawlerNode = $crawler->selectButton('Save');
        $form = $buttonCrawlerNode->form();

        $form['post_type_form[title]'] = 'This is the form title!'; 
        $form['post_type_form[content]'] = 'This is the form content!'; 
        $form['post_type_form[summary]'] = 'This is the form summary';
        $form['post_type_form[slug]'] = 'This is the form slug';
        $form['post_type_form[published]']->tick();

        $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h3', 'Post Blog');
        $this->assertSelectorTextContains('div', 'Post successful! Knowledge is power!');
    }
}
