<?php

namespace App\Controller;

use App\Entity\Billet;
use App\Repository\BilletRepository;
use App\service\BilletService;
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
    public function exemple(SessionInterface $session,BilletRepository $BilletRep,EntityManagerInterface $manager,BilletService $service,Request $request,VoitureRepository $voitureRep){
        $data=$session->get("datas");
        $billet = $session->get("billet");
        $prix=$data->get('prix');
        $voiture=$voitureRep->find($data->get('voitureId'));
        $AllBillet = $BilletRep->findBy(['User'=>$this->getUser()]);

        $user = $this->getUser();
        
        $place=$data->get('place_prise');
        $pl=explode(',',$place);

        $placeVoiture = $service->savePlace($place,$voiture,$pl);
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
