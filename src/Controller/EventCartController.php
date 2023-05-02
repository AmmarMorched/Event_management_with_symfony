<?php

namespace App\Controller;

use App\Entity\EventCart;
use App\Form\EventCartType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/event/cart')]
class EventCartController extends AbstractController
{
    #[Route('/', name: 'app_event_cart_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $eventCarts = $entityManager
            ->getRepository(EventCart::class)
            ->findAll();

        return $this->render('event_cart/index.html.twig', [
            'event_carts' => $eventCarts,
        ]);
    }

    #[Route('/new', name: 'app_event_cart_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $eventCart = new EventCart();
        $form = $this->createForm(EventCartType::class, $eventCart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($eventCart);
            $entityManager->flush();

            return $this->redirectToRoute('app_event_cart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event_cart/new.html.twig', [
            'event_cart' => $eventCart,
            'form' => $form,
        ]);
    }

    #[Route('/{cartId}', name: 'app_event_cart_show', methods: ['GET'])]
    public function show(EventCart $eventCart): Response
    {
        return $this->render('event_cart/show.html.twig', [
            'event_cart' => $eventCart,
        ]);
    }

    #[Route('/{cartId}/edit', name: 'app_event_cart_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EventCart $eventCart, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventCartType::class, $eventCart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_event_cart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event_cart/edit.html.twig', [
            'event_cart' => $eventCart,
            'form' => $form,
        ]);
    }

    #[Route('/{cartId}', name: 'app_event_cart_delete', methods: ['POST'])]
    public function delete(Request $request, EventCart $eventCart, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eventCart->getCartId(), $request->request->get('_token'))) {
            $entityManager->remove($eventCart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_event_cart_index', [], Response::HTTP_SEE_OTHER);
    }
}
