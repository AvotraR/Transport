<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PrixRepository;
use App\Repository\VoitureRepository;
use App\Form\BilletType;
use App\Entity\Billet;
use App\Entity\Prix;

class TransportController extends AbstractController
{
    #[Route('/billet', name: 'app_billet')]
    public function index(PrixRepository $prixRepo,VoitureRepository $voitureRep,Request $request,EntityManagerInterface $manager): Response
    {
       $billet = new Billet(); 
       $prix = 0;
       $voiture = 0;
       $quantite = 0;
        $form = $this->createForm(BilletType::class,$billet);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form-> isValid()){
            $prix = $prixRepo->searchPrix($billet);
            $voiture = $voitureRep->searhVoit($billet);
            $quantite = $billet->getQuantite();
       }
        return $this->render('transport/index.html.twig', [
            'controller_name' => 'TransportController',
            'formBillet' => $form->createView(),
            'prixT'=>$prix,
            'quantite'=>$quantite,
            "voitureDispo"=>$voiture

        ]);
    }
    #[Route('/', name: 'App_home')]
    public function home(){
        return $this->render('transport/home.html.twig',[
            'controller_name'=>'TransportController'
        ]);
    }
}
