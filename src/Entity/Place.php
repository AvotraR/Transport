<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaceRepository::class)]
class Place
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $place = [];

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;


    #[ORM\ManyToOne(inversedBy: 'places')]
    private ?Voiture $voitures = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlace(): array
    {
        return $this->place;
    }

    public function setPlace(array $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getVoitures(): ?Voiture
    {
        return $this->voitures;
    }

    public function setVoitures(?Voiture $voitures): self
    {
        $this->voitures = $voitures;

        return $this;
    }
   
}
