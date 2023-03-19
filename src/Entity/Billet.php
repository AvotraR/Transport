<?php

namespace App\Entity;

use App\Repository\BilletRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BilletRepository::class)]
class Billet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'billets')]
    private ?Destination $destination = null;

    #[ORM\ManyToOne(inversedBy: 'billets')]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'billets')]
    private ?depart $depart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateReservation = null;

    #[ORM\Column(length: 20)]
    private ?string $Nom = null;

    #[ORM\Column(length: 20)]
    private ?string $Prenom = null;

    #[ORM\Column]
    private ?int $Telephone = null;

    #[ORM\Column]
    private ?int $CIN = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'billets')]
    private ?voiture $voiture = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $place = [];




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

    public function getDepart(): ?depart
    {
        return $this->depart;
    }

    public function setDepart(?depart $depart): self
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

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->Telephone;
    }

    public function setTelephone(int $Telephone): self
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getCIN(): ?int
    {
        return $this->CIN;
    }

    public function setCIN(int $CIN): self
    {
        $this->CIN = $CIN;

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

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getVoiture(): ?voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?voiture $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
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



}
