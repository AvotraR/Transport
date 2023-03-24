<?php
namespace App\service;
use App\Entity\Billet;

Class PaiementService{

    public function payer($data,$prix){
        $billet = new Billet();
        $billet=$data;
          foreach($prix as $p){
            $billet->setPrix((($p->getPrix())));
          }
        return $billet;
        
    }   
}