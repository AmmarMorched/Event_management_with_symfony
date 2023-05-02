<?php

namespace App\Controller;

use App\Entity\Evenement;
use Doctrine\ORM\EntityManagerInterface;
use LikeDislike\Likedislike;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LikeDislikeController extends AbstractController
{
    #[Route('/like/{event}/{user}', name: 'app_like_dislike')]
    public function index($event,$user,EntityManagerInterface $entityManager): Response
    {$like = new Likedislike();
        $like->setEvent($event);
        $like->setUser($user);
        
        $entityManager->persist($like);
            $entityManager->flush();

          return   $this->json($like)  ;    
    }

    #[Route('/like', name: 'app_like_dislik')]
    public function like(): Response
    {

          return   $this->json("z")  ;    
    }
}
