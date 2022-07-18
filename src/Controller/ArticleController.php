<?php

namespace App\Controller;

use App\Repository\ArticleMagasinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'article')]
    public function index( ArticleMagasinRepository $article): Response
    {

        return $this->render('article/index.html.twig', [
            'article' => $article->findAll(),
        ]);
    }
}
