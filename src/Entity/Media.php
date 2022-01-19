<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MediaRepository;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\Column(type: 'string', length: 255)]
    private $url;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $alt;

    #[ORM\ManyToOne(targetEntity: Recipe::class, inversedBy: 'media')]
    private $recipe;

    use TimestampableEntity;

    public function __construct() {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(string $type): self {
        $this->type = $type;

        return $this;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function setUrl(string $url): self {
        $this->url = $url;

        return $this;
    }

    public function getAlt(): ?string {
        return $this->alt;
    }

    public function setAlt(?string $alt): self {
        $this->alt = $alt;

        return $this;
    }

    public function getRecipe(): ?Recipe {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self {
        $this->recipe = $recipe;

        return $this;
    }
}
