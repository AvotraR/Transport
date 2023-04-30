<?php

namespace App\Entity;

use App\Entity\Depart;
use App\Entity\Categorie;
use App\Entity\Destination;


class Recherche
{
    private ?int $id = null;
    
    private ?int $Prix = null;

    private ?Depart $Depart = null;

    private ?Destination $Destination = null;
    
    private ?Categorie $Categorie = null;

    private ?\DateTimeInterface $DateReservation = null;

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
}
