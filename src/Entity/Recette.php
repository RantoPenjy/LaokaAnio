<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $recipe_text = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Plat $r_plats = null;

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

    public function getRPlats(): ?Plat
    {
        return $this->r_plats;
    }

    public function setRPlats(?Plat $r_plats): static
    {
        $this->r_plats = $r_plats;

        return $this;
    }
}
