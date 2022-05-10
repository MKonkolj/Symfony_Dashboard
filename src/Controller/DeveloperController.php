<?php

namespace App\Controller;

use App\Entity\Developer;
use App\Repository\DeveloperRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/developer', name: 'developer-')]
class DeveloperController extends AbstractController
{
    private $em;
    public function __construct (EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'index')]
    public function index(DeveloperRepository $devRepo): Response
    {
        $devRepo = $this->em->getRepository(Developer::class);

        $developers = $devRepo->findAll();

        return $this->render('developer/index.html.twig', [
            'developers' => $developers,
        ]);
    }

    #[Route('/{id}', name: 'show')]
    public function show(int $id): Response
    {
        

        return $this->render('developer/index.html.twig', [
            'controller_name' => 'DeveloperController',
        ]);
    }
}
