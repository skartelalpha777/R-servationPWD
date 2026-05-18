<?php

namespace App\Entity;

use App\Repository\RepresentationsRepository;
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
}
