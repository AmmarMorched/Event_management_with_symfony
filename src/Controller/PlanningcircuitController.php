<?php

namespace App\Controller;

use App\Entity\Planningcircuit;
use App\Form\PlanningcircuitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/planningcircuit')]
class PlanningcircuitController extends AbstractController
{
    #[Route('/', name: 'app_planningcircuit_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $planningcircuits = $entityManager
            ->getRepository(Planningcircuit::class)
            ->findAll();

        return $this->render('planningcircuit/index.html.twig', [
            'planningcircuits' => $planningcircuits,
        ]);
    }

    #[Route('/new', name: 'app_planningcircuit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $planningcircuit = new Planningcircuit();
        $form = $this->createForm(PlanningcircuitType::class, $planningcircuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($planningcircuit);
            $entityManager->flush();

            return $this->redirectToRoute('app_planningcircuit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('planningcircuit/new.html.twig', [
            'planningcircuit' => $planningcircuit,
            'form' => $form,
        ]);
    }

    #[Route('/{datedebut}', name: 'app_planningcircuit_show', methods: ['GET'])]
    public function show(Planningcircuit $planningcircuit): Response
    {
        return $this->render('planningcircuit/show.html.twig', [
            'planningcircuit' => $planningcircuit,
        ]);
    }

    #[Route('/{datedebut}/edit', name: 'app_planningcircuit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Planningcircuit $planningcircuit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlanningcircuitType::class, $planningcircuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_planningcircuit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('planningcircuit/edit.html.twig', [
            'planningcircuit' => $planningcircuit,
            'form' => $form,
        ]);
    }

    #[Route('/{datedebut}', name: 'app_planningcircuit_delete', methods: ['POST'])]
    public function delete(Request $request, Planningcircuit $planningcircuit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planningcircuit->getDatedebut(), $request->request->get('_token'))) {
            $entityManager->remove($planningcircuit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_planningcircuit_index', [], Response::HTTP_SEE_OTHER);
    }
}
