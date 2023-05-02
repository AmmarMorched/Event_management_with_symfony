<?php

namespace App\Controller;

use App\Entity\UserFavsplaces;
use App\Form\UserFavsplacesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/favsplaces')]
class UserFavsplacesController extends AbstractController
{
    #[Route('/', name: 'app_user_favsplaces_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $userFavsplaces = $entityManager
            ->getRepository(UserFavsplaces::class)
            ->findAll();

        return $this->render('user_favsplaces/index.html.twig', [
            'user_favsplaces' => $userFavsplaces,
        ]);
    }

    #[Route('/new', name: 'app_user_favsplaces_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $userFavsplace = new UserFavsplaces();
        $form = $this->createForm(UserFavsplacesType::class, $userFavsplace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($userFavsplace);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_favsplaces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_favsplaces/new.html.twig', [
            'user_favsplace' => $userFavsplace,
            'form' => $form,
        ]);
    }

    #[Route('/{idFavs}', name: 'app_user_favsplaces_show', methods: ['GET'])]
    public function show(UserFavsplaces $userFavsplace): Response
    {
        return $this->render('user_favsplaces/show.html.twig', [
            'user_favsplace' => $userFavsplace,
        ]);
    }

    #[Route('/{idFavs}/edit', name: 'app_user_favsplaces_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserFavsplaces $userFavsplace, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserFavsplacesType::class, $userFavsplace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_favsplaces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_favsplaces/edit.html.twig', [
            'user_favsplace' => $userFavsplace,
            'form' => $form,
        ]);
    }

    #[Route('/{idFavs}', name: 'app_user_favsplaces_delete', methods: ['POST'])]
    public function delete(Request $request, UserFavsplaces $userFavsplace, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userFavsplace->getIdFavs(), $request->request->get('_token'))) {
            $entityManager->remove($userFavsplace);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_favsplaces_index', [], Response::HTTP_SEE_OTHER);
    }
}
