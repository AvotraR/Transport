<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    #[Groups("post:read")]
    private ?string $Numero = null;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    private ?Destination $Destination = null;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    private ?Categorie $categorie = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $place = [];

    #[ORM\OneToMany(mappedBy: 'voiture', targetEntity: Billet::class)]
    private Collection $billets;

    #[ORM\Column]
    private ?int $NbPlace = null;

    public function __construct()
    {
        $this->billets = new ArrayCollection();
    }

   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->Numero;
    }

    public function setNumero(string $Numero): self
    {
        $this->Numero = $Numero;

        return $this;
    }

    public function getDestination(): ?destination
    {
        return $this->Destination;
    }

    public function setDestination(?destination $Destination): self
    {
        $this->Destination = $Destination;

        return $this;
    }

    public function getCategorie(): ?categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getPlace(): ?array
    {
        return $this->place;
        
    }

    public function setPlace(?array $place): void
    {
        $this->place = $place;
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
            $billet->setVoiture($this);
        }

        return $this;
    }

    public function removeBillet(Billet $billet): self
    {
        if ($this->billets->removeElement($billet)) {
            // set the owning side to null (unless already changed)
            if ($billet->getVoiture() === $this) {
                $billet->setVoiture(null);
            }
        }

        return $this;
    }

    public function getNbPlace(): ?int
    {
        return $this->NbPlace;
    }

    public function setNbPlace(int $NbPlace): self
    {
        $this->NbPlace = $NbPlace;   
        for($i=0;$i<=$NbPlace;$i++){
            $place[0]=true;
            $place[$i]=false;
        } 
        $this->setPlace($place);

        return $this;
    }

}
