<?php

namespace App\Controller;

use App\Entity\Billet;
use App\Form\BilletType;
use App\Entity\Recherche;
use App\Form\RechercheType;
use App\Form\VoitureModType;
use App\service\PaiementService;
use App\Repository\PrixRepository;
use App\Repository\BilletRepository;
use App\Repository\CategorieRepository;
use App\Repository\DepartRepository;
use App\Repository\DestinationRepository;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Intl\Data\Bundle\Reader\JsonBundleReader;

class TransportController extends AbstractController
{

    #[Route('/billet', name: 'app_billet')]
    public function index(SessionInterface $session,EntityManagerInterface $manager,Request $request, PrixRepository $prixRepo,VoitureRepository $voitureRep,PaiementService $facture): Response
    {
        $Recherche = new Recherche();
        $form = $this->createForm(RechercheType::class,$Recherche);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form-> isValid()){
            $prix = $prixRepo->searchPrix($Recherche);
            $voiture = $voitureRep->searhVoit($Recherche);
            $billet = $facture->prix($Recherche,$prix);
            $session->set("billet",$billet); 
            $session->set("voiture",$voiture);
           // $response = $this->redirectToRoute('App_place_voiture', [], Response::HTTP_SEE_OTHER);
            //return new JsonResponse(['content'=>$response]);
            //if($request->get('ajax')){
            //}
            if($prix==null){
                $this->addFlash('danger','Desolez nous n\'avons pas des voitures pour cette destination');
            }else{    
                 return $this->redirectToRoute('App_place_voiture', [], Response::HTTP_SEE_OTHER);
            }
        }
        return $this->render('transport/reservation.html.twig', [
            'controller_name' => 'TransportController',
            'formBillet' => $form->createView()

        ]);
    }
    #[Route ('/billet/edit', name:'App_place_voiture')]
    public function place(VoitureRepository $voitureRep,SessionInterface $session,Request $request,EntityManagerInterface $manager){
            $voitures = $session->get("voiture");
            $billet = $session->get("billet");
            dump($request);
            return $this->render('transport/_content.html.twig', [
                        'controller_name' => 'TransportController',
                        'voitures'=>$voitures,
                        'billet'=>$billet
            ]);   
    }
    #[Route('/billet/paiement', name:'App_payer')]
    public function payer(SessionInterface $session,CategorieRepository $catRepo,DepartRepository $departRep,DestinationRepository $destRep,Request $request, EntityManagerInterface $manager){
        $this->addFlash('success','Votre reservation a été préenregistrer il reste juste le paiement');
        $facture = $session->get("billet");
        $billet = new Billet();
        $form = $this->createForm(BilletType::class,$billet);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $billet->setDepart($departRep->find($facture->getDepart()))
                    ->setDestination($destRep->find($facture->getDestination()))
                    ->setPrix($facture->getPrix())
                    ->setDateReservation($facture->getDateReservation())
                    ->setCategorie($catRepo->find($facture->getCategorie()))
                    ->setPlace($facture->getPlace());
            foreach($facture->getVoiture() as $i){
                $billet->addVoiture($i);
            }
            $manager->merge($billet);
            $manager->flush();
        }
        return $this->render('transport/paiement.html.twig',[
            'billet'=>$facture,
            'form'=>$form->createView(),
            'controller_name'=>'TransportController']);
    }
    #[Route('/', name: 'App_home')]
    public function home(SessionInterface $session,EntityManagerInterface $manager,Request $request, PrixRepository $prixRepo,VoitureRepository $voitureRep,PaiementService $facture){
        $Recherche = new Recherche();
        $form = $this->createForm(RechercheType::class,$Recherche);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form-> isValid()){
            $prix = $prixRepo->searchPrix($Recherche);
            $voiture = $voitureRep->searhVoit($Recherche);
            $billet = $facture->prix($Recherche,$prix);
            $session->set("billet",$billet); 
            $session->set("voiture",$voiture);
            if($prix==null){
                $this->addFlash('danger','Desolez nous n\'avons pas des voitures pour cette destination');
            }else{    
                return $this->redirectToRoute('App_place_voiture', [], Response::HTTP_SEE_OTHER);
            }
        }
        return $this->render('transport/home.html.twig',[
            'controller_name'=>'TransportController',
            'formBillet' => $form->createView()
        ]);
    }
}
