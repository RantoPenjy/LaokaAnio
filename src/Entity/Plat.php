<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\PlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatRepository::class)]
#[ApiResource]
#[GetCollection]
#[Get]
#[Post(security: "is_granted('IS_AUTHENTICATED_FULLY')")]
#[Patch(security: "is_granted('IS_AUTHENTICATED_FULLY')")]
#[Put(security: "is_granted('IS_AUTHENTICATED_FULLY')")]
#[Delete(security: "is_granted('IS_AUTHENTICATED_FULLY')")]
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

    #[ORM\ManyToOne(inversedBy: 'plats')]
    private ?DayType $day_type = null;

    /**
     * @var Collection<int, Viande>
     */
    #[ORM\ManyToMany(targetEntity: Viande::class, inversedBy: 'plats')]
    private Collection $viandes;

    /**
     * @var Collection<int, NonViande>
     */
    #[ORM\ManyToMany(targetEntity: NonViande::class, inversedBy: 'plats')]
    private Collection $non_viandes;

    public function __construct()
    {
        $this->viandes = new ArrayCollection();
        $this->non_viandes = new ArrayCollection();
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

    public function getDayType(): ?DayType
    {
        return $this->day_type;
    }

    public function setDayType(?DayType $day_type): static
    {
        $this->day_type = $day_type;

        return $this;
    }

    /**
     * @return Collection<int, Viande>
     */
    public function getViandes(): Collection
    {
        return $this->viandes;
    }

    public function addViande(Viande $viande): static
    {
        if (!$this->viandes->contains($viande)) {
            $this->viandes->add($viande);
        }

        return $this;
    }

    public function removeViande(Viande $viande): static
    {
        $this->viandes->removeElement($viande);

        return $this;
    }

    /**
     * @return Collection<int, NonViande>
     */
    public function getNonViandes(): Collection
    {
        return $this->non_viandes;
    }

    public function addNonViande(NonViande $nonViande): static
    {
        if (!$this->non_viandes->contains($nonViande)) {
            $this->non_viandes->add($nonViande);
        }

        return $this;
    }

    public function removeNonViande(NonViande $nonViande): static
    {
        $this->non_viandes->removeElement($nonViande);

        return $this;
    }
}
