<?php

namespace App\Entity;

use App\Repository\DepartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartRepository::class)]
class Depart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\OneToMany(mappedBy: 'depart', targetEntity: Prix::class)]
    private Collection $prixes;

    #[ORM\OneToMany(mappedBy: 'depart', targetEntity: Billet::class)]
    private Collection $billets;

    public function __construct()
    {
        $this->prixes = new ArrayCollection();
        $this->billets = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Prix>
     */
    public function getPrixes(): Collection
    {
        return $this->prixes;
    }

    public function addPrix(Prix $prix): self
    {
        if (!$this->prixes->contains($prix)) {
            $this->prixes[] = $prix;
            $prix->setDepart($this);
        }

        return $this;
    }

    public function removePrix(Prix $prix): self
    {
        if ($this->prixes->removeElement($prix)) {
            // set the owning side to null (unless already changed)
            if ($prix->getDepart() === $this) {
                $prix->setDepart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Billet>
     */
    public function getBillets(): Collection
    {
        return $this->billets;
    }

    public function addBillet(Billet $billet): self
    {
        if (!$this->billets->contains($billet)) {
            $this->billets[] = $billet;
            $billet->setDepart($this);
        }

        return $this;
    }

    public function removeBillet(Billet $billet): self
    {
        if ($this->billets->removeElement($billet)) {
            // set the owning side to null (unless already changed)
            if ($billet->getDepart() === $this) {
                $billet->setDepart(null);
            }
        }

        return $this;
    }


}
