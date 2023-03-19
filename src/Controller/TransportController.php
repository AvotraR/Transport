<?php

namespace App\Controller;

use App\Entity\Prix;
use App\Entity\Billet;
use App\Form\PlaceType;
use App\Form\BilletType;
use App\Form\VoitureType;
use App\Form\VoitureModType;
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
            $session->get("voiture", []);  
            $dataVoiture = $session->set("voiture",$voiture); 
            $paie = true; 
            return $this->redirectToRoute('App_place_voiture', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('transport/index.html.twig', [
            'controller_name' => 'TransportController',
            'formBillet' => $form->createView(),
            'prixT'=>$prix,
            'quantite'=>$quantite,
            "voitureDispo"=>$voiture,
            'paie'=>$paie,

        ]);
    }
    #[Route ('/billet/edit', name:'App_place_voiture')]
    public function place(SessionInterface $session,Request $request,EntityManagerInterface $manager,VoitureRepository $voitureRepository){
            $voitures = $session->get("voiture");
            $formBuilder=$this->createFormBuilder();
            foreach($voitures as $voiture){
                $formBuilder->add('voiture_'.$voiture->getId(),VoitureModType::class,['data'=>$voiture]);
            }
            $form = $formBuilder->getForm();
            $form->handleRequest($request);
            if($form->isSubmitted() && $form-> isValid()){       
                foreach($voitures as $voiture){
                    $voitureModifier = $form->get('voitures_'.$voiture->getId())->getData();
                    $voiture->setDestination($voitureModifier->getDestination());
                    $voiture->setPlace($voitureModifier->getPlace());
                    $manager->persist($voiture);
                }
                $manager->flush();
            }
            return $this->render('transport/editer.html.twig', [
                        'controller_name' => 'TransportController',
                        'form' => $form->createView(),
                        'voitures'=>$voiture
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
