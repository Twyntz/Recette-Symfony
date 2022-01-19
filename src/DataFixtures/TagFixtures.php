<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class TagFixtures extends Fixture implements OrderedFixtureInterface {
    public const USER_ADMIN_REFERENCE = "user-admin";

    public function getOrder() {
        return 2;
    }

    public function load(ObjectManager $manager): void {
        $tag1 = new Tag();
        $tag1->setName("Pate")
        ;
        $manager->persist($tag1);

        $tag2 = new Tag();
        $tag2->setName("Entrée")
        ;
        $manager->persist($tag2);

        $tag3 = new Tag();
        $tag3->setName("Plat")
        ;
        $manager->persist($tag3);

        // flush = $query->execute()
        $manager->flush();
    }
}
