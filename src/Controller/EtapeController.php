<?php

namespace App\Controller;

use App\Entity\Etape;
use App\Form\EtapeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/etape')]
class EtapeController extends AbstractController
{
    #[Route('/', name: 'app_etape_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $etapes = $entityManager
            ->getRepository(Etape::class)
            ->findAll();

        return $this->render('etape/index.html.twig', [
            'etapes' => $etapes,
        ]);
    }

    #[Route('/new', name: 'app_etape_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $etape = new Etape();
        $form = $this->createForm(EtapeType::class, $etape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($etape);
            $entityManager->flush();

            return $this->redirectToRoute('app_etape_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etape/new.html.twig', [
            'etape' => $etape,
            'form' => $form,
        ]);
    }

    #[Route('/{rang}', name: 'app_etape_show', methods: ['GET'])]
    public function show(Etape $etape): Response
    {
        return $this->render('etape/show.html.twig', [
            'etape' => $etape,
        ]);
    }

    #[Route('/{rang}/edit', name: 'app_etape_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Etape $etape, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EtapeType::class, $etape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_etape_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etape/edit.html.twig', [
            'etape' => $etape,
            'form' => $form,
        ]);
    }

    #[Route('/{rang}', name: 'app_etape_delete', methods: ['POST'])]
    public function delete(Request $request, Etape $etape, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etape->getRang(), $request->request->get('_token'))) {
            $entityManager->remove($etape);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_etape_index', [], Response::HTTP_SEE_OTHER);
    }
}
