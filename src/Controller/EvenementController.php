<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Eventsreview;
use App\Entity\User;
use App\Entity\Users;
use App\Form\EvenementType;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
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
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, MailerInterface $mailer): Response
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
            $users = $entityManager
                ->getRepository(User::class)
                ->findAll();

            foreach ($users as $key => $user) {
                if ($user->getRole() != "Admin") {
                    $mail = (new TemplatedEmail())->from(new Address("roadreveltrip@gmail.com"))->to($user->getUserMail()) // bch mnensech  nbadlouh bmail luser connecte 
                        ->subject("A new event has been created")->htmlTemplate(
                            'evenement/email.html.twig'
                        )->context([
                            'event' => $evenement,
                            "user" => $user 

                        ]);

                    $mailer->send($mail);
                }
            }




            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{eventId}', name: 'app_evenement_show', methods: ['GET'])]
    public function show(Evenement $evenement , EntityManagerInterface $entityManager): Response
    {
        $writer = new PngWriter();

        // Create QR code
        $qrCode = QrCode::create("Nom :" . $evenement->getEventName() . "\ndescription : " . $evenement->getEventDescription())
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(100)
            ->setMargin(0)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255, 127));
        // Create generic logo

        // Create generic label
        $label = Label::create('Label')
            ->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode);

        $evnementRepository = $entityManager->getRepository(Eventsreview::class);

        $reviews = $evnementRepository->createQueryBuilder('p')
            ->where('p.event = :query ')
            ->setParameter('query',  $evenement->getEventId())
            ->getQuery()
            ->getResult();
        return $this->render('evenement/show.html.twig', [
            'qr' => $result->getDataUri(),
            'evenement' => $evenement,
            "reviews"=>$reviews
        ]);
    }

    #[Route('/{eventId}/edit', name: 'app_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evenement $evenement, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
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
        if ($this->isCsrfTokenValid('delete' . $evenement->getEventId(), $request->request->get('_token'))) {
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }




    /* public function search(EntityManagerInterface $entityManager, Request $request)
    {
        $query = $request->query->get('q');    
        $qb = $entityManager->createQueryBuilder();
        $qb->select('e')
            ->from(Evenement::class, 'e')
            ->where('e.nom LIKE :query')
            ->setParameter('query', '%'.$query.'%');
    
        $results = $qb->getQuery()->getResult();
        return $this->render('evenement/search.html.twig', [
            'results' => $results,
        ]);
    } */



    /* #[Route('/search', name: 'ajax_search', methods: ['GET'])]
    public function searchAction(Request $request, EntityManagerInterface $entityManager)
    {
        
        $requestString = $request->get('q');
        $evenements = $entityManager->getRepository(Evenement::class)
        ->findEntitiesByString($requestString);
        
        if (!$evenements) {
            $result['evenements']['error'] = "NOT FOUND";
        } else {
            $result['evenements'] = $this->getRealEntities($evenements);
        }

        return new Response(json_encode($result));
    }

    public function getRealEntities($evenements)
    {

        foreach ($evenements as $evenement) {
            $realEntities[$evenement->getEventName()] = $evenement->getTitle() ;/*  $charitydemand->getReceiver() ;
        }
        return $realEntities;
    }  */



    #[Route('/search/evenement', name: 'app_evenement_search', methods: ['GET'])]
    public function search(Request $request, EntityManagerInterface $entityManager)
    {
        $search = $request->query->get('search');
        $evnementRepository = $entityManager
            ->getRepository(Evenement::class)
            ->findAll();
        $evnementRepository = $entityManager->getRepository(Evenement::class);

        $searchResults = $evnementRepository->createQueryBuilder('p')
            ->where('p.eventId = :query OR p.eventName LIKE :query OR p.eventDescription LIKE :query OR p.cityname LIKE :query OR p.eventprice = :query OR p.startDate = :query OR p.endDate LIKE :query')
            ->setParameter('query', '%' . $search . '%')
            ->getQuery()
            ->getResult();
        return  $this->json($searchResults);
    }
}
