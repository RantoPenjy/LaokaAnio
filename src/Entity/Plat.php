<?php

namespace App\Entity;

use App\Repository\PlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatRepository::class)]
class Plat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $min_price_per_person = null;

    #[ORM\ManyToOne(inversedBy: 'r_plats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DayType $r_day = null;

    /**
     * @var Collection<int, Viande>
     */
    #[ORM\ManyToMany(targetEntity: Viande::class, inversedBy: 'r_plats')]
    private Collection $r_viande;

    /**
     * @var Collection<int, NonViande>
     */
    #[ORM\ManyToMany(targetEntity: NonViande::class, inversedBy: 'r_plats')]
    private Collection $r_non_viande;

    public function __construct()
    {
        $this->r_viande = new ArrayCollection();
        $this->r_non_viande = new ArrayCollection();
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

    public function getRDay(): ?DayType
    {
        return $this->r_day;
    }

    public function setRDay(?DayType $r_day): static
    {
        $this->r_day = $r_day;

        return $this;
    }

    /**
     * @return Collection<int, Viande>
     */
    public function getRViande(): Collection
    {
        return $this->r_viande;
    }

    public function addRViande(Viande $rViande): static
    {
        if (!$this->r_viande->contains($rViande)) {
            $this->r_viande->add($rViande);
        }

        return $this;
    }

    public function removeRViande(Viande $rViande): static
    {
        $this->r_viande->removeElement($rViande);

        return $this;
    }

    /**
     * @return Collection<int, NonViande>
     */
    public function getRNonViande(): Collection
    {
        return $this->r_non_viande;
    }

    public function addRNonViande(NonViande $rNonViande): static
    {
        if (!$this->r_non_viande->contains($rNonViande)) {
            $this->r_non_viande->add($rNonViande);
        }

        return $this;
    }

    public function removeRNonViande(NonViande $rNonViande): static
    {
        $this->r_non_viande->removeElement($rNonViande);

        return $this;
    }
}
