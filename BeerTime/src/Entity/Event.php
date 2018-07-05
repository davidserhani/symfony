<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 * @UniqueEntity("name")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=3,
     *     minMessage="name of the event must have at least {{ limit }} characters")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=10,
     *     max=500,
     *     minMessage="description of the event must have at least {{ limit }} characters",
     *     maxMessage="description of the event must have {{ limit }} characters max"
     * )
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @Assert\GreaterThan(0, message="Max people is invalid")
     * @Assert\Type(
     *     type="integer",
     *     message="{{ value }} is not an integer"
     * )
     * @ORM\Column(type="integer", nullable=true)
     *
     */
    private $capacity;

    /**
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @Assert\GreaterThan(
     *     "now",
     *     message="it's a joke ?"
     * )
     * @ORM\Column(type="datetime")
     */
    private $startAt;

    /**
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @Assert\Expression(
     *     "this.getStartAt() < this.getEndAt()",
     *     message="the event can't finish before it start !"
     * )
     * @ORM\Column(type="datetime")
     */
    private $endAt;

    /**
     * @Assert\GreaterThan(0)
     * @Assert\Type(
     *     type="float",
     *     message="invalid price"
     * )
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $poster;

    /**
     * @Assert\Image(
     *     maxSize="2M",
     *     maxSizeMessage="The file is to big"
     * )
     */
    private $posterFile;

    /**
     * @Assert\Url()
     *
     */
    private $posterUrl;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="tableEvents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="events")
     */
    private $registration;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="tableEvents")
     */
    private $category;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="App\Entity\Place", inversedBy="eventPlace")
     * @ORM\JoinColumn(nullable=false)
     */
    private $place;


    public function __construct()
    {
        $this->registration = new ArrayCollection();
        $this->category = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(?int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getStartAt()
    {
        return $this->startAt;
    }

    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt()
    {
        return $this->endAt;
    }

    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getRegistration(): Collection
    {
        return $this->registration;
    }

    public function addRegistration(User $registration): self
    {
        if (!$this->registration->contains($registration)) {
            $this->registration[] = $registration;
        }

        return $this;
    }

    public function removeRegistration(User $registration): self
    {
        if ($this->registration->contains($registration)) {
            $this->registration->removeElement($registration);
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
        }

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getPosterFile(): ?string
    {
        return $this->posterFile;
    }

    public function setPosterFile(string $posterFile)
    {
        $this->posterFile = $posterFile;

        return $this;
    }

    public function getPosterUrl()
    {
        return $this->posterUrl;
    }

    public function setPosterUrl(string $posterUrl)
    {
        $this->posterUrl = $posterUrl;

        return $this;
    }

    /**@Assert\Callback()
     * @param ExecutionContextInterface $context
     * @param ExecutionContextInterface $payload
     */
    public function validate( ExecutionContextInterface $context, $payload ) {
        if ( null === $this->posterFile AND empty( $this->posterUrl ) ) {
            $context->buildViolation('select a picture or put an url')
                ->atPath('posterFile')
                ->addViolation();
            $context->buildViolation('put an url or select a picture')
                ->atPath('posterUrl')
                ->addViolation();
        }
    }
}
