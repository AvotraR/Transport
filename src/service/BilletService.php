<?php
namespace App\service;

use App\Entity\Billet;
use App\Repository\DepartRepository;
use App\Repository\CategorieRepository;
use App\Repository\DestinationRepository;

class BilletService{
    public function reservationService($catRepo,$departRep,$destRep,$billetReserver){
        $billet = new Billet(); 
        $billet->setDepart($departRep->find($billetReserver->getDepart()))
                    ->setDestination($destRep->find($billetReserver->getDestination()))
                    ->setPrix($billetReserver->getPrix())
                    ->setDateReservation($billetReserver->getDateReservation())
                    ->setCategorie($catRepo->find($billetReserver->getCategorie()));
        return $billet;
    }
}


