<?php

namespace App\Entity;

use App\Repository\BilletRepository;
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

}
