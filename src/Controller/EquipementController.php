<?php

namespace App\Controller;

use App\Repository\EquipementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipementController extends AbstractController
{
    #[Route('/equipement', name: 'equipement')]
    public function index( EquipementRepository $equipement): Response
    {
        return $this->render('equipement/index.html.twig', [
            'equipement' => $equipement->findAll(),
        ]);
    }
}
