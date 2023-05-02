<?php

namespace App\Controller;

use App\Entity\Eventsreview;
use App\Entity\Evenement;
use App\Form\EventsreviewType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



#[Route('/eventsreview')]
class EventsreviewController extends AbstractController
{
    #[Route('/', name: 'app_eventsreview_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $eventsreviews = $entityManager
            ->getRepository(Eventsreview::class)
            ->findAll();
            
            

        return $this->render('eventsreview/index.html.twig', [
            'eventsreviews' => $eventsreviews,
        ]);
    }

    #[Route('/new/{eventId}', name: 'app_eventsreview_new', methods: ['GET', 'POST'])]
    public function new($eventId,Request $request, EntityManagerInterface $entityManager): Response
    {

       $event = $entityManager
            ->getRepository(Evenement::class)
            ->find($eventId);
        $eventsreview = new Eventsreview();
        $eventsreview->setEvent($event);

        $form = $this->createForm(EventsreviewType::class, $eventsreview);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $badwords = array("fuck" , "shit" , "ficken" );
            $re = '/\b('.implode('|', $badwords).')\b/';
            $str= $eventsreview->getReviewTxt();
            if( preg_match($re,$str) ==1 )
           { $eventsreview->setEventName("lljlkjlkj");
      

        } 
  
        $eventsreview->setReviewTxt(    preg_replace($re, '*******', $str));
          $this->addFlash(
            'notice', 'Your review text contain a bad word.carefull don\'t use it again or you will get banned'
        );
        $entityManager->persist($eventsreview);
        $entityManager->flush();
        return $this->redirectToRoute('app_evenement_show', ['eventId'=>$eventId]);

        }

        return $this->renderForm('eventsreview/new.html.twig', [
            'eventsreview' => $eventsreview,
            'form' => $form,
        ]);
    }

    #[Route('/{reviewId}', name: 'app_eventsreview_show', methods: ['GET'])]
    public function show(Eventsreview $eventsreview): Response
    {
        return $this->render('eventsreview/show.html.twig', [
            'eventsreview' => $eventsreview,
        ]);
    }

    #[Route('/{reviewId}/edit', name: 'app_eventsreview_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Eventsreview $eventsreview, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventsreviewType::class, $eventsreview);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->flush();

            return $this->redirectToRoute('app_eventsreview_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('eventsreview/edit.html.twig', [
            'eventsreview' => $eventsreview,
            'form' => $form,
            
        ]);
    }

    #[Route('/{reviewId}', name: 'app_eventsreview_delete', methods: ['POST'])]
    public function delete(Request $request, Eventsreview $eventsreview, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eventsreview->getReviewId(), $request->request->get('_token'))) {
            $entityManager->remove($eventsreview);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_eventsreview_index', [], Response::HTTP_SEE_OTHER);
    }

}
