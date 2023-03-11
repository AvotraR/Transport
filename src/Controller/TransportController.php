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
use App\service\PaiementService;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TransportController extends AbstractController
{

    #[Route('/billet', name: 'app_billet')]
    public function index(PrixRepository $prixRepo,VoitureRepository $voitureRep,PaiementService $facture,Request $request,EntityManagerInterface $manager,SessionInterface $session): Response
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
            $session->get("billet", []);
            $facture = $facture->payer($billet,$prix);    
            $dataBillet = $session->set("billet",$facture);
       }
        return $this->render('transport/index.html.twig', [
            'controller_name' => 'TransportController',
            'formBillet' => $form->createView(),
            'prixT'=>$prix,
            'quantite'=>$quantite,
            "voitureDispo"=>$voiture,

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
