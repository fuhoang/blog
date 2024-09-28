<?php

namespace App\Tests\Entity;
use App\Entity\Post;

use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    public function testPostCreate(): void
    {
        $post = new Post();	// Create Post object.
        $post->setTitle("This is the blog title!");
        $post->setContent("Some content goes here!");
        $post->setMetaTitle("Meta title goes here!");
        $post->setSlug("Slug of blog goes here!");
        $post->setSummary("Summary of blog goes here!");

        $post->setPublished(true);
        $post->setCreatedAt(new \DateTime('2015/12/02 07:59:15'));
        $post->setUpdatedAt(new \DateTime('2015/12/02 07:59:15'));
        $post->setPublishedAt(new \DateTime('2015/12/02 07:59:15'));

        $this->assertEquals("This is the blog title!", $post->getTitle());
        $this->assertEquals("Some content goes here!", $post->getContent());
        $this->assertEquals("Meta title goes here!", $post->getMetaTitle());
        $this->assertEquals("Slug of blog goes here!", $post->getSlug());
        $this->assertEquals("Summary of blog goes here!", $post->getSummary());

        $this->assertEquals(new \DateTime('2015/12/02 07:59:15'), $post->getCreatedAt());
        $this->assertEquals(new \DateTime('2015/12/02 07:59:15'), $post->getUpdatedAt());
        $this->assertEquals(new \DateTime('2015/12/02 07:59:15'), $post->getPublishedAt());
    }
}
