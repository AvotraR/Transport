<?php
namespace App\service;
use App\Entity\Billet;
use DateTime;

Class PaiementService{

    public function prix($data,$prix){
        $date = new DateTime();
          foreach($prix as $p){
            $data->setPrix((($p->getPrix())));
          }
        return $data;
        
    }  
}