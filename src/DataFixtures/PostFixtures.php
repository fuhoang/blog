<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $post = new Post();
        $post->setTitle('The Dark Knight');
        $post->setContent('bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla');

        $now = new \DateTime('now' , new \DateTimeZone('Europe/Berlin') );
        $post->setCreatedAt($now);
        $post->setMetaTitle('Some info goes here....');
        $post->setUpdatedAt($now);
        $post->setPublished(true);
        $post->setPublishedAt($now);
        $post->setSlug('some, words, or, tags, or, tags, can, go, here');
        $post->setSummary('You can write a summary of the post here');
        $manager->persist($post);

        $post1 = new Post();
        $post1->setTitle('Costa Rica');
        $post1->setContent('bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla');

        $now = new \DateTime('now' , new \DateTimeZone('Europe/Berlin') );
        $post1->setCreatedAt($now);
        $post1->setMetaTitle('Some info goes here....');
        $post1->setUpdatedAt($now);
        $post1->setPublished(false);
        $post1->setPublishedAt($now);
        $post1->setSlug('some, words, or, tags, or, tags, can, go, here');
        $post1->setSummary('You can write a summary of the post here');
        $manager->persist($post1);

        $manager->flush();
    }
}
