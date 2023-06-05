<?php

namespace App\Controller\Admin;

use App\Entity\Billet;
use App\Entity\Depart;
use App\Entity\Voiture;
use App\Entity\Categorie;
use App\Form\VoitureType;
use App\Entity\Destination;
use App\Repository\VoitureRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
         return $this->render('admin/Dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Transport');
    }
    #[Route('/admin/liste', name:'Liste')]
    public function Liste(Request $request, VoitureRepository $voitureRepository): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $Nbplace = $voiture->getNbPlace();
            for($i=0;$i<=$Nbplace;$i++){
                $place[0]=true;
                $place[$i]=false;
            } 
            $voiture->setPlace($place);
            $voitureRepository->add($voiture, true);
            return $this->redirectToRoute('app_voiture_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('/admin/Liste.html.twig', [
            'form'=>$form->createView(),
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Categorie', 'fa fa-list' , Categorie::class);
        yield MenuItem::linkToCrud('Depart', 'fa fa-flag' , Depart::class);
        yield MenuItem::linkToCrud('Destination', 'fa fa-flag-checkered' , Destination::class);
        yield MenuItem::linkToCrud('Voiture', 'fa fa-car' , Voiture::class);
        yield MenuItem::linkToCrud('Billet', 'fa fa-flag-checkered' , Billet::class);
        
        yield MenuItem::linkToRoute('Liste par voiture','fa fa-flag','Liste');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
