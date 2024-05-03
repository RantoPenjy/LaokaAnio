<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $recipe_text = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Plat $plat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipeText(): ?string
    {
        return $this->recipe_text;
    }

    public function setRecipeText(string $recipe_text): static
    {
        $this->recipe_text = $recipe_text;

        return $this;
    }

    public function getPlat(): ?Plat
    {
        return $this->plat;
    }

    public function setPlat(?Plat $plat): static
    {
        $this->plat = $plat;

        return $this;
    }
}
