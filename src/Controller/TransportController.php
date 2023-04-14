<?php

namespace App\Controller;

use App\Entity\Billet;
use App\Form\BilletType;
use App\Form\VoitureModType;
use App\service\PaiementService;
use App\Repository\PrixRepository;
use App\Repository\VoitureRepository;
use App\Controller\AbstractBaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransportController extends AbstractBaseController
{

    #[Route('/billet', name: 'app_billet')]
    public function index(PrixRepository $prixRepo,VoitureRepository $voitureRep,PaiementService $facture): Response
    {
        $billet = new Billet();
        $form = $this->createForm(BilletType::class,$billet);
        $form->handleRequest($this->request);
        if($form->isSubmitted() && $form-> isValid()){
            $prix = $prixRepo->searchPrix($billet);
            $voiture = $voitureRep->searhVoit($billet);
            $facture = $facture->prix($billet,$prix);    
            $this->session->get("billet", []);
            $this->session->get("voiture", []);  
            $this->session->set("billet",$facture); 
            $this->session->set("voiture",$voiture); 
            if($prix==null){
                $this->addFlash('danger','Desolez nous n\'avons pas des iteneraire pour cette destination');
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
    public function place(VoitureRepository $voitureRep){
            $voitures = $this->session->get("voiture");
            $billet = $this->session->get("billet");
            $formBuilder=$this->createFormBuilder();
            
            foreach($voitures as $voiture){
                $voiture = $voitureRep->find($voiture->getId());
                $formBuilder->add('voiture_'.$voiture->getId(),
                                  VoitureModType::class,
                                  ['data'=>$voiture,'attr'=>['class'=>'schema']]
                            );
                $form = $formBuilder->getForm();
                $form->handleRequest($this->request);

                if($form->isSubmitted() && $form-> isValid()){
                    $voitureModifier = $form->get('voiture_'.$voiture->getId())->getData();
                    //on cherche la voiture correspondant a $id qui vient de request
                    $id=$voitureRep->find($this->request->request->get('id_voiture'));
                    $billet->setVoiture($id);
                    //on modifie place avec les valeurs recu dans vue
                    $voiture->setPlace($voitureModifier->getPlace());
                    $billet->setPlace($this->request->request->get('place_total'));
                    //on met un condition que si prix=0 on lance une message sinon on persist
                    if($this->request->request->get('prix')==0){
                        $this->addFlash('danger','Vous ne ouvez pas faire un paiement parceque vous n\'avez pas encore pris une place.');
                    }else{
                        $billet->setPrix($this->request->request->get('prix'));    
                        $this->manager->persist($voiture);
                        $this->manager->flush();
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
    public function payer(){
        $this->addFlash('success','Votre reservation a été préenregistrer il reste juste le paiement');
        $facture = $this->session->get("billet");
        
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
