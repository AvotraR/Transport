<?php

namespace App\Controller;

use App\Entity\Prix;
use App\Entity\Billet;
use App\Form\BilletType;
use App\Form\VoitureType;
use App\service\PaiementService;
use App\Repository\PrixRepository;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TransportController extends AbstractController
{

    #[Route('/billet', name: 'app_billet')]
    public function index(PrixRepository $prixRepo,VoitureRepository $voitureRep,PaiementService $facture,Request $request,EntityManagerInterface $manager,SessionInterface $session): Response
    {
       $billet = new Billet(); 
       $prix = 0;
       $voiture = 0;
       $quantite = 0;
       $paie = false;
        $form = $this->createForm(BilletType::class,$billet);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form-> isValid()){
            $prix = $prixRepo->searchPrix($billet);
            $voiture = $voitureRep->searhVoit($billet);
            $quantite = $billet->getQuantite();
            $session->get("billet", []);
            $facture = $facture->payer($billet,$prix);    
            $dataBillet = $session->set("billet",$facture);    
            $paie = true;
       }
        return $this->render('transport/index.html.twig', [
            'controller_name' => 'TransportController',
            'formBillet' => $form->createView(),
            'prixT'=>$prix,
            'quantite'=>$quantite,
            "voitureDispo"=>$voiture,
            'paie'=>$paie

        ]);
    }
    #[Route('/billet/paiement', name:'App_payer')]
    public function payer(SessionInterface $session){
        $facture = $session->get("billet");
        return $this->render('transport/paiement.html.twig',[
            'billet'=>$facture,
            'controller_name'=>'TransportController']);
    }
    #[Route('/', name: 'App_home')]
    public function home(){
        return $this->render('transport/home.html.twig',[
            'controller_name'=>'TransportController'
        ]);
    }
}
