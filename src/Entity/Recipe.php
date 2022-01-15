<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text')]
    private $task;

    #[ORM\Column(type: 'integer')]
    private $duration;

    #[ORM\ManyToOne(targetEntity: DifficultyLevel::class, inversedBy: 'recipes')]
    #[ORM\JoinColumn(nullable: false)]
    private $difficultyLevel;

    use TimestampableEntity;

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTask(): ?string
    {
        return $this->task;
    }

    public function setTask(string $task): self {
        $this->task = $task;

        return $this;
    }

    public function getDuration(): ?int {
        return $this->duration;
    }

    public function setDuration(int $duration): self {
        $this->duration = $duration;

        return $this;
    }

    public function getDifficultyLevel(): ?DifficultyLevel {
        return $this->difficultyLevel;
    }

    public function setDifficultyLevel(?DifficultyLevel $difficultyLevel): self {
        $this->difficultyLevel = $difficultyLevel;

        return $this;
    }
}
