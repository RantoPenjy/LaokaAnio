<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\PlatController;
use App\Dto\PlatInput;
use App\Form\PlatInputType;
use App\Repository\PlatRepository;
use App\State\Processor\PlatProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: PlatRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/plats/random',
            controller: PlatController::class,
            openapiContext: [
                'summary' => 'Retrieve a random plat',
                'description' => 'Retrieves a random plat based on the current day'
            ],
            paginationEnabled: false,
            normalizationContext: ['groups' => ['read:plat']],
            name: 'random',
        ),
        new GetCollection(
            uriTemplate: '/viande/{id}/plats',
            uriVariables: [
                'id' => new Link(toProperty: 'viandes', fromClass: Viande::class, identifiers: ['id']),
            ],
            openapiContext: [
                'summary' => 'Retrieve the collection of Plats resources from Viandes id',
                'description' => 'Retrieve the collection of Plats resources from Viandes id'
            ],
            paginationEnabled: false,
            normalizationContext: ['groups' => ['read:plat_from']]
        ),
        new GetCollection(
            uriTemplate: '/nonviande/{id}/plats',
            uriVariables: [
                'id' => new Link(toProperty: 'non_viandes', fromClass: NonViande::class, identifiers: ['id']),
            ],
            openapiContext: [
                'summary' => 'Retrieve the collection of Plats resources from NonViandes id',
                'description' => 'Retrieve the collection of Plats resources from non Viandes id'
            ],
            paginationEnabled: false,
            normalizationContext: ['groups' => ['read:plat_from']]
        ),
        new Post(
            normalizationContext: ['groups' => ['read:plat']],
            denormalizationContext: ['groups' => ['post:plat']],
            input: PlatInput::class,
            processor: PlatProcessor::class
        )
    ],
)]
#[GetCollection(
    normalizationContext: ['groups' => ['read_collection:plat']],
)]
#[Patch]
#[Put]
#[Delete]
class Plat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read_collection:plat', 'read:plat', 'read:plat_from'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read_collection:plat', 'post:plat', 'read:plat', 'read:plat_from'])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['read_collection:plat', 'post:plat', 'read:plat', 'read:plat_from'])]
    private ?int $min_price_per_person = null;

    #[ORM\ManyToOne(inversedBy: 'plats')]
    #[Groups(['read_collection:plat', 'post:plat', 'read:plat', 'read:plat_from'])]
    private ?DayType $day_type = null;

    /**
     * @var Collection<int, Viande>
     */
    #[ORM\ManyToMany(targetEntity: Viande::class, inversedBy: 'plats')]
    #[Groups(['read_collection:plat', 'post:plat', 'read:plat', 'read:plat_from'])]
    private Collection $viandes;

    /**
     * @var Collection<int, NonViande>
     */
    #[ORM\ManyToMany(targetEntity: NonViande::class, inversedBy: 'plats')]
    #[Groups(['read_collection:plat', 'post:plat', 'read:plat', 'read:plat_from'])]
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
