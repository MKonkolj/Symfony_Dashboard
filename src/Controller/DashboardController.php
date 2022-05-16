<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Task;
use App\Entity\User;
use App\Form\ClientFormType;
use App\Form\RegistrationFormType;
use App\Form\TaskFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function developers(Request $request): Response
    {
        // Redirect user if not Admin
        if(!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('dashboard_my-profile');
        }

        // Get all users
        $developersRepo = $this->em->getRepository(User::class);
        $developers = $developersRepo->findAll();

        
        // create add developer form
        // this form is handled by RegistrationController.php
        $user = new User();
        $addForm = $this->createForm(RegistrationFormType::class, $user, [
            'action' => $this->generateUrl('dashboard_register')
        ]);

        return $this->render('dashboard/developers.html.twig', [
            "developers" => $developers,
            "add_user_form" => $addForm->createView()
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
    public function clients(Request $request): Response
    {   
        // Redirect user if not Admin
        if(!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('dashboard_my-profile');
        }

        // get all clients
        $clientRepo = $this->em->getRepository(Client::class);
        $clients = $clientRepo->findAll();

        // generate add client form
        $newClient = new Client();
        $addForm = $this->createForm(ClientFormType::class, $newClient);

        // handle add client request
        $addForm->handleRequest($request);
        if ($addForm->isSubmitted() && $addForm->isValid()) {

            // set placeholder avatar path, to be changed later
            $newClient->setAvatar("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJWG5HUp6TKCEj4RDQ2q0PZ1vjp0YJ_LtXr1cXepxZmSeiB4qHHK0ofSaZj33H3WpKdgI&usqp=CAU");

            $this->em->persist($newClient);
            $this->em->flush();

            return $this->redirectToRoute('dashboard_clients');
        }
        
        return $this->render('dashboard/clients.html.twig', [
            "clients" => $clients,
            "add_client_form" => $addForm->createView()
        ]);
    }

    #[Route('/client/{id}', name: 'client_show')]
    public function clientShow($id, Request $request): Response
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

        // generate form to edit client and handle request
        $form = $this->createForm(ClientFormType::class, $client);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $client = $form->getData();
            $clientRepo->add($client);

            return $this->redirectToRoute("dashboard_client_show", ["id" => $id]);
        }

        return $this->render('dashboard/client-show.html.twig', [
            "client" => $client,
            "tasks" => $tasks,
            "form" => $form->createView()
        ]);
    }

    #[Route('/client/edit/{id}', name: 'edit-client')]
    public function editClient($id): Response
    {
        // get client by id
        $clientRepo = $this->em->getRepository(Client::class);
        $client = $clientRepo->find($id);

        return $this->redirectToRoute("dashboard_client_show", ["id" => $id]);
    }

    /////////////// MY PROFILE routes //////////////////
    #[Route('/my-profile', name: 'my-profile')]
    public function myProfile(Security $security, Request $request): Response
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

        // generate form for adding tasks
        $task = new Task();
        $form = $this->createForm(TaskFormType::class, $task);

        // handle add task request
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $task->setDeveloper($activeUser);

            $this->em->persist($task);
            $this->em->flush();

            return $this->redirectToRoute('dashboard_my-profile');
        }


        return $this->render('dashboard/my-profile.html.twig', [
            "profile" => $profile,
            "tasks" => $tasks,
            "add_task_form" => $form->createView()
        ]);
    }

    /////////////// delete route //////////////////
    #[Route('/{route}/delete/{id}', name: 'delete', methods: ["GET", "DELETE"])]
    public function delete($route, $id): Response
    {   
        // Redirect user if not Admin
        if(!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('dashboard_my-profile');
        }

        // provera iz koje tabele brišemo podatke
        // ukoliko brišemo iz task tabele, menjamo table u myprofile da bi redirekcija odvela na tu stranicu
        switch ($route) {
            case "developer":
                $repository = $this->em->getRepository(User::class);
                $route = "developers";
                break;
            case "client":
                $repository = $this->em->getRepository(Client::class);
                $route = "clients";
                break;
            case "task":
                $repository = $this->em->getRepository(Task::class);
                $route = "my-profile";
                break;
            default:
                return $this->redirectToRoute("dashboard_my-profile");
        }
        
        $row = $repository->find($id);
        $this->em->remove($row);
        $this->em->flush();

        return $this->redirectToRoute("dashboard_" . $route);
    }
}