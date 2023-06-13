<?php

namespace App\Controller;

use App\Entity\Recherche;
use App\Form\RechercheType;
use App\Form\Recherche2Type;
use App\service\VoitureService;
use App\service\PaiementService;
use App\Repository\PrixRepository;
use App\Repository\PlaceRepository;
use App\Repository\VoitureRepository;
use App\service\BilletService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TransportController extends AbstractController
{
    #[Route('/billet/Place', name: 'App_Place')]
    public function CarPlace(SessionInterface $session,BilletService $billetService,PlaceRepository $placeRep,Request $request){
        $voitures = $session->get("voiture");
        $billet = $session->get("billet");
        $places = $billetService->findPlace($billet,$voitures);
        if($request->request->count()>0){
            $session->get("datas");
            $data = $request->request;
            $session->set("datas",$data);
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('transport/reservation.html.twig', [
                    'voitures'=>$voitures,
                    'billet'=>$billet,
                    'placesA'=>$places
                ]);
    }
    
    #[Route('/', name: 'App_home')]
    public function home(SessionInterface $session,Request $request, PrixRepository $prixRepo,VoitureRepository $voitureRep,PaiementService $facture){
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
                return $this->redirectToRoute('App_Place', [], Response::HTTP_SEE_OTHER);
            }
        }
        return $this->render('transport/home.html.twig',[
            'controller_name'=>'TransportController',
            'formBillet' => $form->createView()
        ]);
    }

}
