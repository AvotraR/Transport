<?php

namespace App\Entity;

use App\Repository\PrixRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrixRepository::class)]
class Prix
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\ManyToOne(inversedBy: 'prixes')]
    private ?Destination $destination = null;

    #[ORM\ManyToOne(inversedBy: 'prixes')]
    private ?Categorie $Categorie = null;

    #[ORM\ManyToOne(inversedBy: 'prixes')]
    private ?Depart $depart = null;

    public function getId(): ?int
    {
        return $this->id;
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
        return $this->Categorie;
    }

    public function setCategorie(?Categorie $Categorie): self
    {
        $this->Categorie = $Categorie;

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

}
