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

    #[ORM\ManyToOne(inversedBy: 'billets',cascade:["persist"])]
    #[Groups("post:read")]
    private ?Destination $destination = null;

    #[ORM\ManyToOne(inversedBy: 'billets',cascade:["persist"])]
    #[Groups("post:read")]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'billets',cascade:["persist"])]
    #[Groups("post:read")]
    private ?Depart $depart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups("post:read")]
    private ?\DateTimeInterface $DateReservation = null;

    #[ORM\Column(length: 20)]
    #[Groups("post:read")]
    private ?string $Nom = null;

    #[ORM\Column(length: 20)]
    #[Groups("post:read")]
    private ?string $Prenom = null;

    #[ORM\Column]
    #[Groups("post:read")]
    private ?int $Telephone = null;

    #[ORM\Column]
    #[Groups("post:read")]
    private ?int $CIN = null;

    #[ORM\Column]
    #[Groups("post:read")]
    private ?int $prix = null;

    #[ORM\Column(length: 20)]
    #[Groups("post:read")]
    private ?string $place = null;

    #[ORM\ManyToMany(targetEntity: Voiture::class, inversedBy: 'billets',cascade:["persist"])]
    private Collection $voitures;

    public function __construct()
    {
        $this->voitures = new ArrayCollection();
    }

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

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    /**
     * @return Collection<int, Voiture>
     */
    public function getVoitures(): Collection
    {
        return $this->voitures;
    }

    public function addVoiture(Voiture $voiture): self
    {
        if (!$this->voitures->contains($voiture)) {
            $this->voitures[] = $voiture;
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): self
    {
        $this->voitures->removeElement($voiture);

        return $this;
    }

}
