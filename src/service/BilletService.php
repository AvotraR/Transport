<?php
namespace App\service;

use App\Entity\Place;
use App\Entity\Billet;
use App\Repository\PlaceRepository;
use App\Repository\DepartRepository;
use App\Repository\CategorieRepository;
use App\Repository\DestinationRepository;

class BilletService{
    protected DepartRepository $departRep;
    protected CategorieRepository $catRepo;
    protected DestinationRepository $destRep;
    protected PlaceRepository $placeRep;
    
    public function __construct(DepartRepository $departRep,CategorieRepository $catRepo,DestinationRepository $destRep,PlaceRepository $placeRep)
    {
        $this->departRep = $departRep;
        $this->catRepo = $catRepo;
        $this->destRep = $destRep;
        $this->placeRep = $placeRep;
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
        foreach($voitures as $voiture){
            $places = $this->placeRep->findBy(['voitures'=>$voiture->getId(),'date'=>$billet->getDateReservation()]);
            return $places; 
        }
    }
}


