<?php
namespace App\service;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\VoitureRepository;

class VoitureService{
    
    protected VoitureRepository $voitureRep;
    protected EntityManagerInterface $manager;

    public function __construct(VoitureRepository $voitureRep, EntityManagerInterface $manager)
    {
        $this->voitureRep = $voitureRep;
        $this->manager = $manager;
    }
    
    public function editDate($datas){

        $voitures=$datas['voiture'];
        
        foreach($voitures as $voiture){
            $v = $this->voitureRep->find($voiture);
            $v->setDateDepart(date_create($datas['date']));
            $this->manager->persist($v);
        }
        $this->manager->flush();

    }
}