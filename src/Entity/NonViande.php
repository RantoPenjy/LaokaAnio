<?php

namespace App\Entity;

use App\Repository\NonViandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: NonViandeRepository::class)]
class NonViande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read_collection:plat', 'post:plat', 'read:plat', 'read:plat_from'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read_collection:plat', 'post:plat', 'read:plat', 'read:plat_from'])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['read_collection:plat', 'post:plat', 'read:plat', 'read:plat_from'])]
    private ?int $min_price_per_person = null;

    /**
     * @var Collection<int, Plat>
     */
    #[ORM\ManyToMany(targetEntity: Plat::class, mappedBy: 'non_viandes')]
    private Collection $plats;

    public function __construct()
    {
        $this->plats = new ArrayCollection();
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
    public function getPlats(): Collection
    {
        return $this->plats;
    }

    public function addPlat(Plat $plat): static
    {
        if (!$this->plats->contains($plat)) {
            $this->plats->add($plat);
            $plat->addNonViande($this);
        }

        return $this;
    }

    public function removePlat(Plat $plat): static
    {
        if ($this->plats->removeElement($plat)) {
            $plat->removeNonViande($this);
        }

        return $this;
    }
}
