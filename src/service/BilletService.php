<?php
namespace App\service;

use App\Entity\Billet;
use App\Repository\DepartRepository;
use App\Repository\CategorieRepository;
use App\Repository\DestinationRepository;

class BilletService{
    protected DepartRepository $departRep;
    protected CategorieRepository $catRepo;
    protected DestinationRepository $destRep;
    
    public function __construct(DepartRepository $departRep,CategorieRepository $catRepo,DestinationRepository $destRep)
    {
        $this->departRep = $departRep;
        $this->catRepo = $catRepo;
        $this->destRep = $destRep;
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
    public function savePlace($place,$voiture,$placePrise){
        $place=$voiture->getPlace();
        for($i=0;$i<=$voiture->getNbPlace();$i++){
            foreach($placePrise as $k){
                    $place[$k]=true;
            }
            $voiture->setPlace($place);
        } 
        return $voiture;
    }
}


