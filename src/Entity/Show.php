<?php

namespace App\Entity;

use App\Repository\ShowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShowRepository::class)]
#[ORM\Table(name: '`show`')]
class Show
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poster_URL = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column]
    private ?\DateTime $created_in = null;

    #[ORM\Column]
    private ?bool $bookable = null;

    /**
     * @var Collection<int, Representation>
     */
    #[ORM\OneToMany(targetEntity: Representation::class, mappedBy: 'representationShow')]
    private Collection $reservations;

    #[ORM\ManyToOne(inversedBy: 'shows')]
    private ?Location $location = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'showReview')]
    private Collection $review;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->created_in = new \DateTime();
        $this->review = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getPosterURL(): ?string
    {
        return $this->poster_URL;
    }

    public function setPosterURL(?string $poster_URL): static
    {
        $this->poster_URL = $poster_URL;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getCreatedIn(): ?\DateTime
    {
        return $this->created_in;
    }

    public function setCreatedIn(\DateTime $created_in): static
    {
        $this->created_in = $created_in;

        return $this;
    }

    public function isBookable(): ?bool
    {
        return $this->bookable;
    }

    public function setBookable(bool $bookable): static
    {
        $this->bookable = $bookable;

        return $this;
    }

    /**
     * @return Collection<int, Representation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Representation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setRepresentationShow($this);
        }

        return $this;
    }

    public function removeReservation(Representation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getRepresentationShow() === $this) {
                $reservation->setRepresentationShow(null);
            }
        }

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getShowReview(): Collection
    {
        return $this->review;
    }

    public function addShowReview(Review $showReview): static
    {
        if (!$this->review->contains($showReview)) {
            $this->review->add($showReview);
            $showReview->setShowReview($this);
        }

        return $this;
    }

    public function removeShowReview(Review $showReview): static
    {
        if ($this->review->removeElement($showReview)) {
            // set the owning side to null (unless already changed)
            if ($showReview->getShowReview() === $this) {
                $showReview->setShowReview(null);
            }
        }

        return $this;
    }
}
