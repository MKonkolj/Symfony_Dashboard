<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/developer', name: 'developer-')]
class DeveloperController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('developer/index.html.twig', [
            'controller_name' => 'DeveloperController',
        ]);
    }

    #[Route('/{id}', name: 'show')]
    public function show(): Response
    {
        return $this->render('developer/index.html.twig', [
            'controller_name' => 'DeveloperController',
        ]);
    }
}
