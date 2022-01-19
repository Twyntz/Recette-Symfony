<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface {
    public const USER_ADMIN_REFERENCE = "user-admin";

    public function getOrder() {
        return 3;
    }

    public function load(ObjectManager $manager): void {
        $user = new User();
        $user->setUsername("Admin")
            ->setPassword("password")
        ;
        $this->addReference(self::USER_ADMIN_REFERENCE, $user);
        $manager->persist($user);

        // flush = $query->execute()
        $manager->flush();
    }
}
