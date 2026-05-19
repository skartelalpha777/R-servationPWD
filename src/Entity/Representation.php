<?php

namespace App\Entity;

use App\Repository\RepresentationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepresentationRepository::class)]
class Representation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $schedule = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Show $representationShow = null;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'representation')]
    private Collection $reservations;

    #[ORM\Column(nullable: false)]
    private ?float $Price = null;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSchedule(): ?\DateTime
    {
        return $this->schedule;
    }

    public function setSchedule(\DateTime $schedule): static
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getRepresentationShow(): ?Show
    {
        return $this->representationShow;
    }

    public function setRepresentationShow(?Show $representationShow): static
    {
        $this->representationShow = $representationShow;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(?float $Price): static
    {
        $this->Price = $Price;

        return $this;
    }
}
