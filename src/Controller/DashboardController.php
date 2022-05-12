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

    /////////////// DEVELOPER routes //////////////////
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

        // get tasks by developer id
        $taskRepo = $this->em->getRepository(Task::class);
        $tasks = $taskRepo->findDeveloperTasks($id);

        return $this->render('dashboard/developer-show.html.twig', [
            "developer" => $developer,
            "tasks" => $tasks
        ]);
    }

    /////////////// CLIENT routes //////////////////
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
        $tasks = $taskRepo->findClientTasks($id);

        return $this->render('dashboard/client-show.html.twig', [
            "client" => $client,
            "tasks" => $tasks
        ]);
    }

    /////////////// MY PROFILE routes //////////////////
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
        $tasks = $tasksRepo->findDeveloperTasks($activeUserId);

        return $this->render('dashboard/my-profile.html.twig', [
            "profile" => $profile,
            "tasks" => $tasks
        ]);
    }

    /////////////// delete route //////////////////
    #[Route('/{table}/delete/{id}', name: 'delete', methods: ["GET", "DELETE"])]
    public function delete($table, $id): Response
    {   
        // Redirect user if not Admin
        if(!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('dashboard_my-profile');
        }

        // provera iz koje tabele brišemo podatke
        // ukoliko brišemo iz task tabele, menjamo table u myprofile da bi redirekcija odvela na tu stranicu
        switch ($table) {
            case "developer":
                $repository = $this->em->getRepository(User::class);
                break;
            case "client":
                $repository = $this->em->getRepository(Client::class);
                break;
            case "task":
                $repository = $this->em->getRepository(Task::class);
                $table = "my-profile";
                break;
            default:
                return $this->redirectToRoute("dashboard_my-profile");
        }
        
        $row = $repository->find($id);
        $this->em->remove($row);
        $this->em->flush();

        return $this->redirectToRoute("dashboard_" . $table);
    }
}