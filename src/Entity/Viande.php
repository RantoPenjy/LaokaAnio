<?php

namespace App\Entity;

use App\Repository\ViandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ViandeRepository::class)]
class Viande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $min_price_per_person = null;

    /**
     * @var Collection<int, Plat>
     */
    #[ORM\ManyToMany(targetEntity: Plat::class, mappedBy: 'r_viande')]
    private Collection $r_plats;

    public function __construct()
    {
        $this->r_plats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMinPricePerPerson(): ?int
    {
        return $this->min_price_per_person;
    }

    public function setMinPricePerPerson(int $min_price_per_person): static
    {
        $this->min_price_per_person = $min_price_per_person;

        return $this;
    }

    /**
     * @return Collection<int, Plat>
     */
    public function getRPlats(): Collection
    {
        return $this->r_plats;
    }

    public function addRPlat(Plat $rPlat): static
    {
        if (!$this->r_plats->contains($rPlat)) {
            $this->r_plats->add($rPlat);
            $rPlat->addRViande($this);
        }

        return $this;
    }

    public function removeRPlat(Plat $rPlat): static
    {
        if ($this->r_plats->removeElement($rPlat)) {
            $rPlat->removeRViande($this);
        }

        return $this;
    }
}
