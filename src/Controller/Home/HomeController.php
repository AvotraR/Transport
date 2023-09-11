<?php

namespace App\Controller\Home;

use App\Entity\Recherche;
use App\Form\RechercheType;
use App\service\BilletService;
use App\service\PaiementService;
use App\Repository\PrixRepository;
use App\Repository\VoitureRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

Class HomeController extends AbstractController
{
    #[Route('/', name: 'App_home')]
    public function home(SessionInterface $session,Request $request,BilletService $billetService, PrixRepository $prixRepo,VoitureRepository $voitureRep,PaiementService $facture):Response
    {        
        $Recherche = new Recherche();

        $form = $this->createForm(RechercheType::class,$Recherche);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form-> isValid()){
            $prix = $prixRepo->searchPrix($Recherche);
            $voiture = $voitureRep->searhVoit($Recherche);
            $billet = $facture->prix($Recherche,$prix);
            $places = $billetService->findPlace($billet,$voiture);

            $session->set("billet",$billet); 
            $session->set("voiture",$voiture);
            $session->set("place",$places);

            if($prix==null){
                $this->addFlash('danger','Desolez nous n\'avons pas des voitures pour cette destination');
            }else{    

                return $this->redirectToRoute('App_Place', [], Response::HTTP_SEE_OTHER);
            }
        }
        
        return $this->render('home/home.html.twig',[
            'controller_name'=>'HomeController',
            'formBillet' => $form->createView()
        ]);
    }
}