<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Entity\Recherche;
use App\Form\RechercheType;
use App\Form\Recherche2Type;
use App\service\VoitureService;
use App\Repository\BilletRepository;
use App\Repository\VoitureRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#[Route('/gestion')]
class GestionVoitureController extends AbstractController
{
    #[Route('/', name: 'app_gestion_voiture')]
    public function index(): Response
    {
        return $this->render('gestion_voiture/index.html.twig', [
            'controller_name' => 'GestionVoitureController',
        ]);
    }
    #[Route('/depart' ,name:'gestion_departVoiture')]
    public function departVoiture(VoitureRepository $voiture,Request $request, VoitureService $v)
    {
        $Recherche = new Recherche();

        $form = $this->createForm(Recherche2Type::class,$Recherche);
        $form->handleRequest($request);
        $voitures = null;

        if($form->isSubmitted() && $form-> isValid()){
            $voitures = $voiture->searhVoit($Recherche);
        }

        if($request->query->count()>1){
            $v->editDate($request->query->all());
        }

        return $this->render('gestion_voiture/voiture.html.twig',[
                'voitures' => $voitures,
                'formBillet' => $form->createView()
        ]);
    }
    #[Route('/reservation' ,name:'gestion_reservation')]
    public function gestionReservation(VoitureRepository $voiture,Request $request, VoitureService $v)
    {
        $Recherche = new Recherche();

        $form = $this->createForm(RechercheType::class,$Recherche);
        $form->handleRequest($request);

        $voitures = null;

        if($form->isSubmitted() && $form-> isValid()){
            $voitures = $voiture->searhVoit($Recherche);
        }

        return $this->render('gestion_voiture/reservation.html.twig',[
                'voitures' => $voitures,
                'formBillet' => $form->createView()
        ]);
    }

    #[Route('/reservation/?{id}/{date}', name:'liste_reservation_voiture')]
    public function voirReservation(Voiture $voiture,$date,BilletRepository $billetRep){
        $billets = $billetRep->findBy(['DateReservation'=>date_create($date),'voiture'=>$voiture]);
        
        return $this->render('gestion_voiture/liste_R.html.twig',[
            'billets' => $billets,
            'date'=>$date
        ]);
    }
}
