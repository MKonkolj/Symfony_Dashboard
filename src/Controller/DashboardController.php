<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Task;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route("/dc7161be3dbf2250c8954e560cc35060", name: "dashboard_")]
class DashboardController extends AbstractController
{
    private $em;
    public function __construct (EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/developers', name: 'developers')]
    public function developers(): Response
    {
        // Redirect user if not Admin
        if(!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('dashboard_my-profile');
        }

        // Get all users
        $developersRepo = $this->em->getRepository(User::class);
        $developers = $developersRepo->findAll();


        return $this->render('dashboard/developers.html.twig', [
            "developers" => $developers
        ]);
    }

    #[Route('/developer/{id}', name: 'developer_show')]
    public function developerShow($id): Response
    {        
        // Redirect user if not Admin
        if(!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('dashboard_my-profile');
        }

        // get developer by id
        $developerRepo = $this->em->getRepository(User::class);
        $developer = $developerRepo->find($id);

        return $this->render('dashboard/developer-show.html.twig', [
            "developer" => $developer
        ]);
    }

    #[Route('/clients', name: 'clients')]
    public function clients(): Response
    {   
        // Redirect user if not Admin
        if(!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('dashboard_my-profile');
        }

        // get all clients
        $clientRepo = $this->em->getRepository(Client::class);
        $clients = $clientRepo->findAll();
        
        return $this->render('dashboard/clients.html.twig', [
            "clients" => $clients
        ]);
    }

    #[Route('/client/{id}', name: 'client_show')]
    public function clientShow($id): Response
    {        
        // Redirect user if not Admin
        if(!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('dashboard_my-profile');
        }

        // get client by id
        $clientRepo = $this->em->getRepository(Client::class);
        $client = $clientRepo->find($id);
        
        // get tasks by client id
        $taskRepo = $this->em->getRepository(Task::class);
        $tasks = $taskRepo->findBy(
            ["client" => $id]
        );

        return $this->render('dashboard/client-show.html.twig', [
            "client" => $client,
            "tasks" => $tasks
        ]);
    }

    #[Route('/my-profile', name: 'my-profile')]
    public function myProfile(Security $security): Response
    {   
        // get id for the logged user
        $activeUser = $security->getUser();
        $activeUserId = $activeUser->getId();

        // get logged user data
        $profileRepo = $this->em->getRepository(User::class);
        $profile = $profileRepo->find($activeUserId);

        // get users taks
        $tasksRepo = $this->em->getRepository(Task::class);
        $tasks = $tasksRepo->findTaskByDeveloperId($activeUserId);

        return $this->render('dashboard/my-profile.html.twig', [
            "profile" => $profile,
            "tasks" => $tasks
        ]);
    }
}