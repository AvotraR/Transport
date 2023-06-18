<?php
namespace App\service;

use App\Entity\Place;
use App\Entity\Billet;
use App\Repository\PlaceRepository;
use App\Repository\DepartRepository;
use App\Repository\VoitureRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DestinationRepository;

class BilletService{
    protected DepartRepository $departRep;
    protected CategorieRepository $catRepo;
    protected DestinationRepository $destRep;
    protected PlaceRepository $placeRep;
    protected EntityManagerInterface $manager;
    protected VoitureRepository $voitureRep;
    public function __construct(DepartRepository $departRep,CategorieRepository $catRepo,DestinationRepository $destRep,PlaceRepository $placeRep,EntityManagerInterface $manager,VoitureRepository $voitureRep)
    {
        $this->departRep = $departRep;
        $this->catRepo = $catRepo;
        $this->destRep = $destRep;
        $this->placeRep = $placeRep;
        $this->manager = $manager;
        $this->voitureRep = $voitureRep;
    }
    public function reservationService($billetReserver,$prix,$place,$voiture,$user){
        $billet = new Billet(); 
        $billet->setDepart($this->departRep->find($billetReserver->getDepart()))
                    ->setDestination($this->destRep->find($billetReserver->getDestination()))
                    ->setPrix($prix)
                    ->setDateReservation($billetReserver->getDateReservation())
                    ->setCategorie($this->catRepo->find($billetReserver->getCategorie()))
                    ->setPlace($place)
                    ->setUser($user)
                    ->setVoiture($voiture);
        return $billet;
    }
        
    public function savePlace($billet,$places,$place,$voiture,$placePrise){
       
        for($i=0;$i<=$voiture->getNbPlace();$i++){
            foreach($placePrise as $k){
                    $place[$k]=true;
                }
                $places->setPlace($place);
        }
        $places->setDate($billet->getDateReservation());
        $places->setVoitures($voiture);
         
        
        return $places;
    }
    public function findPlace($billet,$voitures){
        $places = [];

        foreach ($voitures as $voiture) {
            $place = $this->placeRep->findOneBy(['voitures' => $voiture, 'date' => $billet->getDateReservation()]);
    
            if (!$place) {
                $place = new Place();
                $place->setPlace($voiture->getPlace());
                $place->setDate($billet->getDateReservation());
    
                $voiture->addPlace($place);
    
                $this->manager->persist($place);
                $this->manager->persist($voiture);
            }
    
            $places[] = $place;
        }
    
        $this->manager->flush();
    
        return $places;
    }
}


