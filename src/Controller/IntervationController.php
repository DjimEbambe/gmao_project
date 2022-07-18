<?php

namespace App\Controller;

use App\Entity\Intervation;
use App\Form\IntervationType;
use App\Repository\IntervationRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

#[Route('/intervation')]
class IntervationController extends AbstractController
{

    #[Route('/', name: 'intervation_index', methods: ['GET'])]
    public function index(IntervationRepository $intervationRepository): Response
    {
        return $this->render('intervation/index.html.twig', [
            'intervations' => $intervationRepository->findAll(),
        ]);
    }

    #[Route('/creer', name: 'intervation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $intervation = new Intervation();
        $form = $this->createForm(IntervationType::class, $intervation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = new DateTime();
            $ref_time = date_timestamp_get($date);
            $ref = $ref_time."_".random_int(0, 100);
            $intervation->setReference($ref);
            $intervation->setStatus('encours');

            $entityManager->persist($intervation);
            $entityManager->flush();
            return $this->redirectToRoute('intervation_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('intervation/new.html.twig', [
            'intervation' => $intervation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'intervation_show', methods: ['GET'])]
    public function show(Intervation $intervation): Response
    {
        return $this->render('intervation/show.html.twig', [
            'intervation' => $intervation,
        ]);
    }

    #[Route('/{id}/edit', name: 'intervation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Intervation $intervation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(IntervationType::class, $intervation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $intervation->setUpdatedAt(new DateTime('now'));
            $entityManager->flush();

            return $this->redirectToRoute('intervation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('intervation/edit.html.twig', [
            'intervation' => $intervation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'intervation_delete', methods: ['POST'])]
    public function delete(Request $request, Intervation $intervation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$intervation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($intervation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('intervation_index', [], Response::HTTP_SEE_OTHER);
    }
}
