<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ForumController extends AbstractController
{
    #[Route('/forum', name: 'app_forum')]
    public function index(QuestionRepository $questionRepository, Request $request): Response
    {
        return $this->render('forum/index.html.twig', [
            'controller_name' => 'ForumController',
            'question' => $questionRepository ->find(),
        ]);
    }
}
