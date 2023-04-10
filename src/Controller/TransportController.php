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
use Symfony\Component\Serializer\SerializerInterface;

class TransportController extends AbstractController
{

    #[Route('/billet', name: 'app_billet')]
    public function index(PrixRepository $prixRepo,VoitureRepository $voitureRep,PaiementService $facture,Request $request,EntityManagerInterface $manager,SessionInterface $session): Response
    {
       $billet = new Billet();
       $paie = false;
        $form = $this->createForm(BilletType::class,$billet);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form-> isValid()){
            $prix = $prixRepo->searchPrix($billet);
            $voiture = $voitureRep->searhVoit($billet);
            $session->get("billet", []);
            $facture = $facture->payer($billet,$prix);    
            $dataBillet = $session->set("billet",$facture); 
            $session->get("voiture", []);  
            $dataVoiture = $session->set("voiture",$voiture); 
            if($prix==null){
                $this->addFlash('danger','Desolez nous n\'avons pas des iteneraire pour cette destination');
            }else{    
                return $this->redirectToRoute('App_place_voiture', [], Response::HTTP_SEE_OTHER);
            }
        }
        return $this->render('transport/reservation.html.twig', [
            'controller_name' => 'TransportController',
            'formBillet' => $form->createView(),
            'paie'=>$paie,

        ]);
    }
    #[Route ('/billet/edit', name:'App_place_voiture')]
    public function place(SessionInterface $session,Request $request,VoitureRepository $voitureRep,EntityManagerInterface $manager,VoitureRepository $voitureRepository){
            $voitures = $session->get("voiture");
            $billet = $session->get("billet");
            $formBuilder=$this->createFormBuilder();
            
            foreach($voitures as $voiture){
                $voiture = $voitureRep->find($voiture->getId());
                $formBuilder->add('voiture_'.$voiture->getId(),VoitureModType::class,['data'=>$voiture,'attr'=>['class'=>'schema']]);
                $form = $formBuilder->getForm();
                $form->handleRequest($request);

                if($form->isSubmitted() && $form-> isValid()){
                    $voitureModifier = $form->get('voiture_'.$voiture->getId())->getData();
                    $voiture->setPlace($voitureModifier->getPlace());
                    $id=$voitureRep->find($request->request->get('id_voiture'));
                    $billet->setVoiture($id);
                    $billet->setPlace($request->request->get('place_total'));
                    if($request->request->get('prix')==0){
                        $this->addFlash('danger','Vous ne ouvez pas faire un paiement parceque vous n\'avez pas encore pris une place.');
                    }else{
                        $billet->setPrix($request->request->get('prix'));    
                        $manager->persist($voiture);
                        $manager->flush();
                        return $this->redirectToRoute('App_payer', [], Response::HTTP_SEE_OTHER);
                    }
                    
                }
            }
            return $this->render('transport/editer.html.twig', [
                        'controller_name' => 'TransportController',
                        'form' => $form->createView(),
                        'voitures'=>$voiture,
                        'billet'=>$billet
            ]);   
    }
    #[Route('/billet/paiement', name:'App_payer')]
    public function payer(SessionInterface $session ,SerializerInterface $serialize){
        $this->addFlash('success','Votre reservation a été préenregistrer il reste juste le paiement');
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
