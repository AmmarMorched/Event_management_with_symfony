<?php

namespace App\Controller;

use App\Entity\Reports;
use App\Form\ReportsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reports')]
class ReportsController extends AbstractController
{
    #[Route('/', name: 'app_reports_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reports = $entityManager
            ->getRepository(Reports::class)
           // ->findAll();
            ->createQueryBuilder('e')
            ->orderBy('e.incidentDate', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('reports/index.html.twig', [
            'reports' => $reports,
        ]);
    }

    #[Route('/new', name: 'app_reports_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $report = new Reports();
        $form = $this->createForm(ReportsType::class, $report);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($report);
            $entityManager->flush();

            return $this->redirectToRoute('app_reports_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reports/new.html.twig', [
            'report' => $report,
            'form' => $form,
        ]);
    }

    #[Route('/{reportId}', name: 'app_reports_show', methods: ['GET'])]
    public function show(Reports $report): Response
    {
        return $this->render('reports/show.html.twig', [
            'report' => $report,
        ]);
    }

    #[Route('/{reportId}/edit', name: 'app_reports_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reports $report, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReportsType::class, $report);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reports_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reports/edit.html.twig', [
            'report' => $report,
            'form' => $form,
        ]);
    }

    #[Route('/{reportId}', name: 'app_reports_delete', methods: ['POST'])]
    public function delete(Request $request, Reports $report, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$report->getReportId(), $request->request->get('_token'))) {
            $entityManager->remove($report);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reports_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/search/reports', name: 'app_reports_search', methods: ['GET'])]
    public function search(Request $request, EntityManagerInterface $entityManager)
    {
        $search = $request->query->get('search');
        $reportsRepository = $entityManager

        ->getRepository(Reports::class)
        ->findAll();
        if ($search) {
            $reportsRepository = $entityManager->getRepository(Reports::class);

     $searchResults = $reportsRepository->createQueryBuilder('p')
    ->where('p.reportId = :query OR p.reportSubject LIKE :query OR p.incidentLocation LIKE :query')
    ->setParameter('query', '%'.$search.'%')
    ->getQuery()
    ->getResult();
        }
        else{
            $searchResults = $entityManager
            ->getRepository(Reports::class)
            ->findAll();
        }

           return  $this->json($searchResults);

    }
}
