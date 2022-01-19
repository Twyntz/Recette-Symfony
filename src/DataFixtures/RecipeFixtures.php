<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\DifficultyLevelFixtures;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class RecipeFixtures extends Fixture implements OrderedFixtureInterface {
    public const RECIPE_PATE_REFERENCE = "recette-de-pate";

    public function getOrder() {
        return 6;
    }

    public function load(ObjectManager $manager): void {
        $recipe = new Recipe();
        $recipe->setName("Pâte à la carbonara")
            ->setTask("bidon")
            ->setDuration(20)
            ->setDifficultyLevel($this->getReference(DifficultyLevelFixtures::DIFFICULTY_LEVEL_EASY_REFERENCE))
            ->setAuthor($this->getReference(UserFixtures::USER_ADMIN_REFERENCE))
        ;
        $this->addReference(self::RECIPE_PATE_REFERENCE, $recipe);
        $manager->persist($recipe);
        // persist est nécessaire sinon manager ne s'en occupera pas

        // flush = $query->execute()
        $manager->flush();
    }
}
