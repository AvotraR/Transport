<?php

namespace App\Controller;

use App\Entity\Depart;
use App\Form\DepartType;
use App\Repository\DepartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/depart')]
class DepartController extends AbstractController
{
    #[Route('/', name: 'app_depart_index', methods: ['GET'])]
    public function index(DepartRepository $departRepository): Response
    {
        return $this->render('depart/index.html.twig', [
            'departs' => $departRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_depart_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DepartRepository $departRepository): Response
    {
        $depart = new Depart();
        $form = $this->createForm(DepartType::class, $depart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $departRepository->add($depart, true);

            return $this->redirectToRoute('app_depart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('depart/new.html.twig', [
            'depart' => $depart,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_depart_show', methods: ['GET'])]
    public function show(Depart $depart): Response
    {
        return $this->render('depart/show.html.twig', [
            'depart' => $depart,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_depart_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Depart $depart, DepartRepository $departRepository): Response
    {
        $form = $this->createForm(DepartType::class, $depart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $departRepository->add($depart, true);

            return $this->redirectToRoute('app_depart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('depart/edit.html.twig', [
            'depart' => $depart,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_depart_delete', methods: ['POST'])]
    public function delete(Request $request, Depart $depart, DepartRepository $departRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$depart->getId(), $request->request->get('_token'))) {
            $departRepository->remove($depart, true);
        }

        return $this->redirectToRoute('app_depart_index', [], Response::HTTP_SEE_OTHER);
    }
}
