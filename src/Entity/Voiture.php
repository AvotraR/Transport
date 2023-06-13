<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\VoitureRepository;
use DateTime;
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

    #[ORM\Column]
    private ?int $NbPlace = null;

    #[ORM\Column]
    private ?bool $isArrived = null;


    #[ORM\OneToMany(mappedBy: 'voiture', targetEntity: Billet::class)]
    private Collection $Reservation;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDepart = null;

    #[ORM\OneToMany(mappedBy: 'voitures', targetEntity: Place::class)]
    private Collection $places;




    public function __construct()
    {
        $this->Reservation = new ArrayCollection();
        $this->places = new ArrayCollection();
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

    public function isIsArrived(): ?bool
    {
        $now = new DateTime();
        if($this->getDateDepart()<$now){
            $this->setIsArrived(true);
        }
        return $this->isArrived;
    }

    public function setIsArrived(bool $isArrived): self
    {
        $this->isArrived = $isArrived;
        if($isArrived == true){
            $place = $this->getPlace();
            for($i=0;$i<=$this->getNbPlace();$i++){
                $place[0]=true;
                $place[$i]=false;
            }
            $this->setPlace($place);
        }
        return $this;
    }

    public function __toString()
    {
        return $this->Numero;
    }

    /**
     * @return Collection<int, Billet>
     */
    public function getReservation(): Collection
    {
        return $this->Reservation;
    }

    public function addReservation(Billet $reservation): self
    {
        if (!$this->Reservation->contains($reservation)) {
            $this->Reservation[] = $reservation;
            $reservation->setVoiture($this);
        }

        return $this;
    }

    public function removeReservation(Billet $reservation): self
    {
        if ($this->Reservation->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getVoiture() === $this) {
                $reservation->setVoiture(null);
            }
        }

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(?\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    /**
     * @return Collection<int, Place>
     */
    public function getPlaces(): Collection
    {
        return $this->places;
    }

    public function addPlace(Place $place): self
    {
        if (!$this->places->contains($place)) {
            $this->places[] = $place;
            $place->setVoitures($this);
        }

        return $this;
    }

    public function removePlace(Place $place): self
    {
        if ($this->places->removeElement($place)) {
            // set the owning side to null (unless already changed)
            if ($place->getVoitures() === $this) {
                $place->setVoitures(null);
            }
        }

        return $this;
    }
}
