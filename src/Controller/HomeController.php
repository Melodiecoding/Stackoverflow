<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home_index', methods: ['GET'])]
    public function question(QuestionRepository $questionRepository, PaginatorInterface $paginator, Request $request): Response
    {   
        return $this->render('home/index.html.twig', [
            'questions' => $questionRepository->findAll(),
        ]);
    }
}

