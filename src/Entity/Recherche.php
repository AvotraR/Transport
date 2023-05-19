<?php

namespace App\Entity;

use App\Entity\Depart;
use App\Entity\Voiture;
use App\Entity\Categorie;
use App\Entity\Destination;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class Recherche
{
    private ?int $id = null;
    
    private ?int $Prix = null;

    private ?string $Place = null;

    private ?Depart $Depart = null;

    private ?Destination $Destination = null;
    
    private ?Categorie $Categorie = null;

    private ?\DateTimeInterface $DateReservation = null;

    private Collection $Voitures;

    public function __construct()
    {
        $this->Voitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    
    public function getPrix(): ?int
    {
        return $this->Prix;
    }

    public function setPrix(int $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getDepart(): ?Depart
    {
        return $this->Depart;
    }

    public function setDepart(Depart $Depart): self
    {
        $this->Depart = $Depart;

        return $this;
    }
    public function getCategorie(): ?Categorie
    {
        return $this->Categorie;
    }

    public function setCategorie(Categorie $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getDestination(): ?Destination
    {
        return $this->Destination;
    }

    public function setDestination(Destination $Destination): self
    {
        $this->Destination = $Destination;

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
    
    public function getPlace(): ?string
    {
        return $this->Place;
    }

    public function setPlace(string $Place): self
    {
        $this->Place = $Place;

        return $this;
    }
    public function getVoiture(): ?collection
    {
        return $this->Voitures;
    }

    public function setVoiture(Voiture $voitures): self
    { 
        if (!$this->Voitures->contains($voitures)) {
            $this->Voitures[] = $voitures;
        }

    return $this;
    }
}
