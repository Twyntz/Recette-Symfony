<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\DataFixtures\RecipeFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class MediaFixtures extends Fixture implements OrderedFixtureInterface {
    public function getOrder() {
        return 9;
    }

    public function load(ObjectManager $manager): void {
        $media1 = new Media();
        $media1->setType("Image")
            ->setUrl("https://assets.afcdn.com/recipe/20180628/80089_w96h96c1cx1944cy2592cxb3888cyb5184.jpg")
            ->setAlt("Image de pâte Carbonara")
            ->setRecipe($this->getReference(RecipeFixtures::RECIPE_PATE_REFERENCE))
        ;
        $manager->persist($media1);

        // flush = $query->execute()
        $manager->flush();
    }
}
