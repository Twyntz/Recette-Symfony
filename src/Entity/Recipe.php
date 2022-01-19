<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: Ingredient::class, orphanRemoval: true)]
    private $ingredients;

    #[ORM\ManyToMany(targetEntity: Tag::class, mappedBy: 'recipes')]
    private $tags;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: Comment::class, orphanRemoval: true)]
    private $comments;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'recipes')]
    #[ORM\JoinColumn(nullable: false)]
    private $author;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: Media::class)]
    private $media;

    use TimestampableEntity;

    public function __construct() {
        $this->ingredients = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->media = new ArrayCollection();
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    public function getTask(): ?string {
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

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
            $ingredient->setRecipe($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self {
        if ($this->ingredients->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getRecipe() === $this) {
                $ingredient->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection {
        return $this->tags;
    }

    public function addTag(Tag $tag): self {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addRecipe($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self {
        if ($this->tags->removeElement($tag)) {
            $tag->removeRecipe($this);
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection {
        return $this->comments;
    }

    public function addComment(Comment $comment): self {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setRecipe($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getRecipe() === $this) {
                $comment->setRecipe(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?User {
        return $this->author;
    }

    public function setAuthor(?User $author): self {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedia(): Collection {
        return $this->media;
    }

    public function addMedium(Media $medium): self {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
            $medium->setRecipe($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getRecipe() === $this) {
                $medium->setRecipe(null);
            }
        }

        return $this;
    }
}
