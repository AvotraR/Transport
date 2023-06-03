<?php

namespace App\Controller;

use App\Repository\DepartRepository;
use App\Repository\VoitureRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DestinationRepository;
use App\service\BilletService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/utilisateur/billet', name: 'App_user_billet')]
    public function exemple(SessionInterface $session,EntityManagerInterface $manager,BilletService $service,CategorieRepository $catRepo,DepartRepository $departRep,DestinationRepository $destRep,Request $request,VoitureRepository $voitureRep){
        $data=$session->get("datas");
        $billet = $session->get("billet");
        $voiture=$voitureRep->find($data->get('voitureId'));
        $p=$data->get('place_prise');
        $pl=explode(',',$p);
        $place=$voiture->getPlace();
        for($i=0;$i<=$voiture->getNbPlace();$i++){
            foreach($pl as $k){
                    $place[$k]=true;
            }
            $voiture->setPlace($place);
        } 
        $manager->persist($voiture);
        $manager->flush();
        $prix=$data->get('prix');
        return $this->render('user/UserPage.html.twig',['voiture'=>$voiture,'place'=>$p,"prix"=>$prix,'billet'=>$billet]);
    }
}
