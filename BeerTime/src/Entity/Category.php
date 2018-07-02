<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TableEvent", mappedBy="category")
     */
    private $tableEvents;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $icon;

    public function __construct()
    {
        $this->tableEvents = new ArrayCollection();
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
            $tableEvent->addCategory($this);
        }

        return $this;
    }

    public function removeTableEvent(TableEvent $tableEvent): self
    {
        if ($this->tableEvents->contains($tableEvent)) {
            $this->tableEvents->removeElement($tableEvent);
            $tableEvent->removeCategory($this);
        }

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }
}
