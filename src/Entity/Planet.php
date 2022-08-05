<?php

namespace App\Entity;

use App\Repository\PlanetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanetRepository::class)]
class Planet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'planets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\Column]
    private ?int $fields = null;

    #[ORM\Column(nullable: true)]
    private ?int $planetMetal = null;

    #[ORM\Column(nullable: false)]
    private ?int $lastUpdate = null;

    #[ORM\Column(nullable: true)]
    private ?int $buildingsQueueEndTime = null;

    #[ORM\Column(nullable: true)]
    private ?int $metalMineLevel = null;

    #[ORM\Column]
    private ?int $metalPerHour = null;

    public function getId(): ?int
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

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getFields(): ?int
    {
        return $this->fields;
    }

    public function setFields(int $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function getPlanetMetal(): ?int
    {
        return $this->planetMetal;
    }

    public function setPlanetMetal(?int $planetMetal): self
    {
        $this->planetMetal = $planetMetal;

        return $this;
    }

    public function getLastUpdate(): ?int
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(?int $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    public function getBuildingsQueueEndTime(): ?int
    {
        return $this->buildingsQueueEndTime;
    }

    public function setBuildingsQueueEndTime(?int $buildingsQueueEndTime): self
    {
        $this->buildingsQueueEndTime = $buildingsQueueEndTime;

        return $this;
    }

    public function getMetalMineLevel(): ?int
    {
        return $this->metalMineLevel;
    }

    public function setMetalMineLevel(?int $metalMineLevel): self
    {
        $this->metalMineLevel = $metalMineLevel;

        return $this;
    }

    public function getMetalPerHour(): ?int
    {
        return $this->metalPerHour;
    }

    public function setMetalPerHour(int $metalPerHour): self
    {
        $this->metalPerHour = $metalPerHour;

        return $this;
    }

}
