<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;




#[Route('/evenement')]
class EvenementController extends AbstractController
{
    #[Route('/', name: 'app_evenement_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $evenements = $entityManager
           ->getRepository(Evenement::class)
            //->findAll()
            ->createQueryBuilder('e')
            ->orderBy('e.eventName', 'ASC')
            ->getQuery()
            ->getResult();


        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    #[Route('/new', name: 'app_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request,EntityManagerInterface $entityManager,SluggerInterface $slugger): Response
    {
        
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventposter = $form->get('eventposter')->getData();
            $eventPic2 = $form->get('eventPic2')->getData();
            $eventPic3 = $form->get('eventPic3')->getData();
            if ($eventposter && $eventPic2 && $eventPic3) {
                $originalFilename1 = pathinfo($eventposter->getClientOriginalName(), PATHINFO_FILENAME);
                $originalFilename2 = pathinfo($eventPic2->getClientOriginalName(), PATHINFO_FILENAME);
                $originalFilename3 = pathinfo($eventPic3->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename1 = $slugger->slug($originalFilename1);
                $safeFilename2 = $slugger->slug($originalFilename2);
                $safeFilename3 = $slugger->slug($originalFilename3);
                $newFilename1 = $safeFilename1 . '-' . uniqid() . '.' . $eventposter->guessExtension();
                $newFilename2 = $safeFilename2 . '-' . uniqid() . '.' . $eventPic2->guessExtension();
                $newFilename3 = $safeFilename3 . '-' . uniqid() . '.' . $eventPic3->guessExtension();
                try {
                    $eventposter->move(
                        $this->getParameter('img_directory'),
                        $newFilename1
                    );
                    $eventPic2->move(
                        $this->getParameter('img_directory'),
                        $newFilename2
                    );
                    $eventPic3->move(
                        $this->getParameter('img_directory'),
                        $newFilename3
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
    
                $evenement->setEventposter($newFilename1);
                $evenement->setEventPic2($newFilename2);
                $evenement->setEventPic3($newFilename3);
            }
            
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{eventId}', name: 'app_evenement_show', methods: ['GET'])]
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    #[Route('/{eventId}/edit', name: 'app_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evenement $evenement, EntityManagerInterface $entityManager,SluggerInterface $slugger): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventposter = $form->get('eventposter')->getData();
            $eventPic2 = $form->get('eventPic2')->getData();
            $eventPic3 = $form->get('eventPic3')->getData();
            if ($eventposter && $eventPic2 && $eventPic3) {
                $originalFilename1 = pathinfo($eventposter->getClientOriginalName(), PATHINFO_FILENAME);
                $originalFilename2 = pathinfo($eventPic2->getClientOriginalName(), PATHINFO_FILENAME);
                $originalFilename3 = pathinfo($eventPic3->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename1 = $slugger->slug($originalFilename1);
                $safeFilename2 = $slugger->slug($originalFilename2);
                $safeFilename3 = $slugger->slug($originalFilename3);
                $newFilename1 = $safeFilename1 . '-' . uniqid() . '.' . $eventposter->guessExtension();
                $newFilename2 = $safeFilename2 . '-' . uniqid() . '.' . $eventPic2->guessExtension();
                $newFilename3 = $safeFilename3 . '-' . uniqid() . '.' . $eventPic3->guessExtension();
                try {
                    $eventposter->move(
                        $this->getParameter('img_directory'),
                        $newFilename1
                    );
                    $eventPic2->move(
                        $this->getParameter('img_directory'),
                        $newFilename2
                    );
                    $eventPic3->move(
                        $this->getParameter('img_directory'),
                        $newFilename3
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
    
                $evenement->setEventposter($newFilename1);
                $evenement->setEventPic2($newFilename2);
                $evenement->setEventPic3($newFilename3);
            }
            
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{eventId}', name: 'app_evenement_delete', methods: ['POST'])]
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getEventId(), $request->request->get('_token'))) {
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }
}
