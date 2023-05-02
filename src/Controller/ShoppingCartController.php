<?php

namespace App\Controller;

use App\Entity\ShoppingCart;
use App\Form\ShoppingCartType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shopping/cart')]
class ShoppingCartController extends AbstractController
{
    #[Route('/', name: 'app_shopping_cart_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $shoppingCarts = $entityManager
            ->getRepository(ShoppingCart::class)
            ->findAll();

        return $this->render('shopping_cart/index.html.twig', [
            'shopping_carts' => $shoppingCarts,
        ]);
    }

    #[Route('/new', name: 'app_shopping_cart_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $shoppingCart = new ShoppingCart();
        $form = $this->createForm(ShoppingCartType::class, $shoppingCart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($shoppingCart);
            $entityManager->flush();

            return $this->redirectToRoute('app_shopping_cart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('shopping_cart/new.html.twig', [
            'shopping_cart' => $shoppingCart,
            'form' => $form,
        ]);
    }

    #[Route('/{idCart}', name: 'app_shopping_cart_show', methods: ['GET'])]
    public function show(ShoppingCart $shoppingCart): Response
    {
        return $this->render('shopping_cart/show.html.twig', [
            'shopping_cart' => $shoppingCart,
        ]);
    }

    #[Route('/{idCart}/edit', name: 'app_shopping_cart_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ShoppingCart $shoppingCart, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ShoppingCartType::class, $shoppingCart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_shopping_cart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('shopping_cart/edit.html.twig', [
            'shopping_cart' => $shoppingCart,
            'form' => $form,
        ]);
    }

    #[Route('/{idCart}', name: 'app_shopping_cart_delete', methods: ['POST'])]
    public function delete(Request $request, ShoppingCart $shoppingCart, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shoppingCart->getIdCart(), $request->request->get('_token'))) {
            $entityManager->remove($shoppingCart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_shopping_cart_index', [], Response::HTTP_SEE_OTHER);
    }
}
