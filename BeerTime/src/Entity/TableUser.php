<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TableUserRepository")
 */
class TableUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $zipCode;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TableEvent", mappedBy="owner", orphanRemoval=true)
     */
    private $tableEvents;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TableEvent", mappedBy="registration")
     */
    private $events;

    public function __construct()
    {
        $this->tableEvents = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getRole(): ?array
    {
        return $this->role;
    }

    public function setRole(?array $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|TableEvent[]
     */
    public function getTableEvents(): Collection
    {
        return $this->tableEvents;
    }

    public function addTableEvent(TableEvent $tableEvent): self
    {
        if (!$this->tableEvents->contains($tableEvent)) {
            $this->tableEvents[] = $tableEvent;
            $tableEvent->setOwner($this);
        }

        return $this;
    }

    public function removeTableEvent(TableEvent $tableEvent): self
    {
        if ($this->tableEvents->contains($tableEvent)) {
            $this->tableEvents->removeElement($tableEvent);
            // set the owning side to null (unless already changed)
            if ($tableEvent->getOwner() === $this) {
                $tableEvent->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TableEvent[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(TableEvent $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->addRegistration($this);
        }

        return $this;
    }

    public function removeEvent(TableEvent $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            $event->removeRegistration($this);
        }

        return $this;
    }
}
