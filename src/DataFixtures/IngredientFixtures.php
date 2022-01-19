<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use App\DataFixtures\RecipeFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class IngredientFixtures extends Fixture implements OrderedFixtureInterface {
    public function getOrder() {
        return 8;
    }

    public function load(ObjectManager $manager): void {
        $ingredient1 = new Ingredient();
        $ingredient1->setName("Pâte")
            ->setQuantity(500)
            ->setUnit("grammes")
            ->setRecipe($this->getReference(RecipeFixtures::RECIPE_PATE_REFERENCE))
        ;
        $manager->persist($ingredient1);

        $ingredient2 = new Ingredient();
        $ingredient2->setName("Crème")
            ->setQuantity(50)
            ->setUnit("centilitre")
            ->setRecipe($this->getReference(RecipeFixtures::RECIPE_PATE_REFERENCE))
        ;
        $manager->persist($ingredient2);

        $ingredient3 = new Ingredient();
        $ingredient3->setName("Parmesan")
            ->setQuantity(15)
            ->setUnit("gramme")
            ->setRecipe($this->getReference(RecipeFixtures::RECIPE_PATE_REFERENCE))
        ;
        $manager->persist($ingredient3);

        // flush = $query->execute()
        $manager->flush();
    }
}
