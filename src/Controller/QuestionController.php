<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    #[Route('/liste', name: 'app_question')]
    public function index(): Response
    {
        return $this->render('question/list.html.twig', [
            'controller_name' => 'QuestionController',
        ]);
    }
}
