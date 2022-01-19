<?php

namespace App\DataFixtures;

use App\Entity\DifficultyLevel;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class DifficultyLevelFixtures extends Fixture implements OrderedFixtureInterface {
    public const DIFFICULTY_LEVEL_EASY_REFERENCE = "difficulty-level-easy";
    public const DIFFICULTY_LEVEL_NORMAL_REFERENCE = "difficulty-level-normal";
    public const DIFFICULTY_LEVEL_HARD_REFERENCE = "difficulty-level-hard";

    public function getOrder() {
        return 1;
    }

    public function load(ObjectManager $manager): void {
        $easy = new DifficultyLevel();
        $easy->setName("Facile")
            ->setLevel(1)
        ;
        $this->addReference(self::DIFFICULTY_LEVEL_EASY_REFERENCE, $easy);
        $manager->persist($easy);
        // persist est nécessaire sinon manager ne s'en occupera pas
        $normal = new DifficultyLevel();
        $normal->setName("Normal")
            ->setLevel(2)
        ;
        $this->addReference(self::DIFFICULTY_LEVEL_NORMAL_REFERENCE, $normal);
        $manager->persist($normal);
        $hard = new DifficultyLevel();
        $hard->setName("Difficile")
            ->setLevel(3)
        ;
        $this->addReference(self::DIFFICULTY_LEVEL_HARD_REFERENCE, $hard);
        $manager->persist($hard);

        // flush = $query->execute()
        $manager->flush();
    }
}
