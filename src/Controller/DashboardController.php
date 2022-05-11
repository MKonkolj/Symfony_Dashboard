<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/dc7161be3dbf2250c8954e560cc35060", name: "dashboard_")]
class DashboardController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        if(!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('dashboard_my-profile');
        }

        return $this->render('dashboard/index.html.twig');
    }

    #[Route('/developers', name: 'developers')]
    public function developers(): Response
    {
        return $this->render('dashboard/developers.html.twig');
    }

    #[Route('/clients', name: 'clients')]
    public function clients(): Response
    {        
        return $this->render('dashboard/clients.html.twig');
    }

    #[Route('/my-profile', name: 'my-profile')]
    public function myProfile(): Response
    {        
        return $this->render('dashboard/my-profile.html.twig');
    }
}