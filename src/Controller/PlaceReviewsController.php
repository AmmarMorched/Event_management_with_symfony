<?php

namespace App\Controller;

use App\Entity\PlaceReviews;
use App\Form\PlaceReviewsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/place/reviews')]
class PlaceReviewsController extends AbstractController
{
    #[Route('/', name: 'app_place_reviews_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $placeReviews = $entityManager
            ->getRepository(PlaceReviews::class)
            ->findAll();

        return $this->render('place_reviews/index.html.twig', [
            'place_reviews' => $placeReviews,
        ]);
    }

    #[Route('/new', name: 'app_place_reviews_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $placeReview = new PlaceReviews();
        $form = $this->createForm(PlaceReviewsType::class, $placeReview);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($placeReview);
            $entityManager->flush();

            return $this->redirectToRoute('app_place_reviews_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('place_reviews/new.html.twig', [
            'place_review' => $placeReview,
            'form' => $form,
        ]);
    }

    #[Route('/{reviewId}', name: 'app_place_reviews_show', methods: ['GET'])]
    public function show(PlaceReviews $placeReview): Response
    {
        return $this->render('place_reviews/show.html.twig', [
            'place_review' => $placeReview,
        ]);
    }

    #[Route('/{reviewId}/edit', name: 'app_place_reviews_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlaceReviews $placeReview, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlaceReviewsType::class, $placeReview);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_place_reviews_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('place_reviews/edit.html.twig', [
            'place_review' => $placeReview,
            'form' => $form,
        ]);
    }

    #[Route('/{reviewId}', name: 'app_place_reviews_delete', methods: ['POST'])]
    public function delete(Request $request, PlaceReviews $placeReview, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$placeReview->getReviewId(), $request->request->get('_token'))) {
            $entityManager->remove($placeReview);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_place_reviews_index', [], Response::HTTP_SEE_OTHER);
    }
}
