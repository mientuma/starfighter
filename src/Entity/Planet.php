<?php

namespace App\Entity;

use App\Repository\PlanetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanetRepository::class)]
class Planet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\ManyToOne(inversedBy: 'planets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $Owner = null;

    #[ORM\Column]
    private ?int $Fields = null;

    #[ORM\Column(nullable: true)]
    private ?int $PlanetMetal = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $lastUpdate = null;

    #[ORM\Column(nullable: true)]
    private ?int $metalMine = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->Owner;
    }

    public function setOwner(?User $Owner): self
    {
        $this->Owner = $Owner;

        return $this;
    }

    public function getFields(): ?int
    {
        return $this->Fields;
    }

    public function setFields(int $Fields): self
    {
        $this->Fields = $Fields;

        return $this;
    }

    public function getPlanetMetal(): ?int
    {
        return $this->PlanetMetal;
    }

    public function setPlanetMetal(?int $PlanetMetal): self
    {
        $this->PlanetMetal = $PlanetMetal;

        return $this;
    }

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(\DateTimeInterface $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    public function getMetalMine(): ?int
    {
        return $this->metalMine;
    }

    public function setMetalMine(?int $metalMine): self
    {
        $this->metalMine = $metalMine;

        return $this;
    }
}
