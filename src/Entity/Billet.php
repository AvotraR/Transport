<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BilletRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BilletRepository::class)]
class Billet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    #[Groups("post:read")]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'billets')]
    #[Groups("post:read")]
    private ?Destination $destination = null;

    #[ORM\ManyToOne(inversedBy: 'billets')]
    #[Groups("post:read")]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'billets')]
    #[Groups("post:read")]
    private ?Depart $depart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups("post:read")]
    private ?\DateTimeInterface $DateReservation = null;

    #[ORM\Column]
    #[Groups("post:read")]
    private ?int $prix = null;

    #[ORM\Column(length: 20)]
    #[Groups("post:read")]
    private ?string $place = null;

    #[ORM\ManyToOne(inversedBy: 'billets')]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'Reservation')]
    private ?Voiture $voiture = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDestination(): ?Destination
    {
        return $this->destination;
    }

    public function setDestination(?Destination $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDepart(): ?Depart
    {
        return $this->depart;
    }

    public function setDepart(?Depart $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->DateReservation;
    }

    public function setDateReservation(\DateTimeInterface $DateReservation): self
    {
        $this->DateReservation = $DateReservation;

        return $this;
    }
    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?Voiture $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }
}
