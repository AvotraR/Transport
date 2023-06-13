<?php

namespace App\Controller;

use App\Entity\Place;
use App\Entity\Billet;
use App\service\BilletService;
use App\Repository\PlaceRepository;
use App\Repository\BilletRepository;
use App\Repository\DepartRepository;
use App\Repository\VoitureRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DestinationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/utilisateur/billet', name: 'App_user_billet')]
    public function exemple(SessionInterface $session,BilletRepository $BilletRep,PlaceRepository $placeRep,EntityManagerInterface $manager,BilletService $service,Request $request,VoitureRepository $voitureRep){
        $data=$session->get("datas");
        $billet = $session->get("billet");
        $prix=$data->get('prix');
        $voiture=$voitureRep->find($data->get('voitureId'));
        $AllBillet = $BilletRep->findBy(['User'=>$this->getUser()]);
        $placeEntity =$placeRep->findBy(['voitures'=>$voiture->getId(),'date'=>$billet->getDateReservation()]);
        $user = $this->getUser();
        
        $place=$data->get('place_prise');
        $pl=explode(',',$place);
        if(!$placeEntity){
            $newPlace = new Place();    
            $placeee=$voiture->getPlace();
            $placeVoiture = $service->savePlace($billet,$newPlace,$placeee,$voiture,$pl);
            $voiture->addPlace($placeVoiture);
        }else{
            $placeee=$placeEntity[0]->getPlace();
            $placeVoiture = $service->savePlace($billet,$placeEntity[0],$placeee,$voiture,$pl);
        }
        
        $reservation = $service->reservationService($billet,$prix,$place,$voiture,$user);
        if(!($BilletRep->existeDeja($reservation))){
            $manager->persist($placeVoiture);
            $manager->persist($reservation);
            $manager->flush();
        }
        return $this->render('user/UserPage.html.twig',[
            'voiture'=>$voiture,
            'place'=>$place,
            "prix"=>$prix,
            'billet'=>$billet,
            'AllBillet'=>$AllBillet]);
    }
}
