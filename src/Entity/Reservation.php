<?php

namespace App\Entity;

use App\Enum\Status;
use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $booking_date = null;

    #[ORM\Column(enumType: Status::class)]
    private ?Status $status = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?User $user = null;

    #[ORM\Column]
    private ?int $quantity = null;



    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Representation $representation = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalPrice = null;

    function __construct()
    {
        $this->booking_date = new \DateTime();
        $this->status = Status::Pending;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookingDate(): ?\DateTime
    {
        return $this->booking_date;
    }

    public function setBookingDate(\DateTime $booking_date): static
    {
        $this->booking_date = $booking_date;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getRepresentation(): ?Representation
    {
        return $this->representation;
    }

    public function setRepresentation(?Representation $representation): static
    {
        $this->representation = $representation;

        return $this;
    }

    public function getTotalPrice(): ?int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(?int $totalPrice): static
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }
}
