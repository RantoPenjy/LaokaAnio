<?php

namespace App\Entity;

use App\Repository\DayTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DayTypeRepository::class)]
class DayType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $day_type = null;

    /**
     * @var Collection<int, Plat>
     */
    #[ORM\OneToMany(targetEntity: Plat::class, mappedBy: 'r_day')]
    private Collection $r_plats;

    public function __construct()
    {
        $this->r_plats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayType(): ?string
    {
        return $this->day_type;
    }

    public function setDayType(string $day_type): static
    {
        $this->day_type = $day_type;

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
            $rPlat->setRDay($this);
        }

        return $this;
    }

    public function removeRPlat(Plat $rPlat): static
    {
        if ($this->r_plats->removeElement($rPlat)) {
            // set the owning side to null (unless already changed)
            if ($rPlat->getRDay() === $this) {
                $rPlat->setRDay(null);
            }
        }

        return $this;
    }
}
