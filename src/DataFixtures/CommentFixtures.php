<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\RecipeFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class CommentFixtures extends Fixture implements OrderedFixtureInterface {
    public function getOrder() {
        return 7;
    }

    public function load(ObjectManager $manager): void {
        $comment1 = new Comment();
        $comment1->setContent("Woullah c'est une recette mon reuf")
            ->setAuthor($this->getReference(UserFixtures::USER_ADMIN_REFERENCE))
            ->setRecipe($this->getReference(RecipeFixtures::RECIPE_PATE_REFERENCE))
        ;
        $manager->persist($comment1);

        // flush = $query->execute()
        $manager->flush();
    }
}
