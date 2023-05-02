<?php

namespace App\Controller;

use App\Entity\Reservationcircuit;
use App\Form\ReservationcircuitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservationcircuit')]
class ReservationcircuitController extends AbstractController
{
    #[Route('/', name: 'app_reservationcircuit_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservationcircuits = $entityManager
            ->getRepository(Reservationcircuit::class)
            ->findAll();

        return $this->render('reservationcircuit/index.html.twig', [
            'reservationcircuits' => $reservationcircuits,
        ]);
    }

    #[Route('/new', name: 'app_reservationcircuit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationcircuit = new Reservationcircuit();
        $form = $this->createForm(ReservationcircuitType::class, $reservationcircuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationcircuit);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservationcircuit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservationcircuit/new.html.twig', [
            'reservationcircuit' => $reservationcircuit,
            'form' => $form,
        ]);
    }

    #[Route('/{numRes}', name: 'app_reservationcircuit_show', methods: ['GET'])]
    public function show(Reservationcircuit $reservationcircuit): Response
    {
        return $this->render('reservationcircuit/show.html.twig', [
            'reservationcircuit' => $reservationcircuit,
        ]);
    }

    #[Route('/{numRes}/edit', name: 'app_reservationcircuit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservationcircuit $reservationcircuit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationcircuitType::class, $reservationcircuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservationcircuit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservationcircuit/edit.html.twig', [
            'reservationcircuit' => $reservationcircuit,
            'form' => $form,
        ]);
    }

    #[Route('/{numRes}', name: 'app_reservationcircuit_delete', methods: ['POST'])]
    public function delete(Request $request, Reservationcircuit $reservationcircuit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationcircuit->getNumRes(), $request->request->get('_token'))) {
            $entityManager->remove($reservationcircuit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservationcircuit_index', [], Response::HTTP_SEE_OTHER);
    }
}
