<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Task;
use App\Form\ClientFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route("/dc7161be3dbf2250c8954e560cc35060", name: "dashboard_")]
class ClientController extends AbstractController
{
    private $em;
    public function __construct (EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /////////////// All clients list //////////////////
    #[Route('/clients', name: 'clients')]
    public function clients(Request $request, SluggerInterface $slugger): Response
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
            // get uploaded image file name
            $avatarFile = $addForm->get("avatar")->getData();

            if($avatarFile)
            {
                // get filename and remove extension
                $originalFilename = pathinfo($avatarFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . "-" . uniqid() . "." . $avatarFile->guessExtension();

                try {
                    $avatarFile->move(
                        $this->getParameter("profile-images"),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... exeption code
                }

                $newClient->setAvatar($newFilename);
            }

            // set placeholder avatar path, to be changed later
            // $newClient->setAvatar("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJWG5HUp6TKCEj4RDQ2q0PZ1vjp0YJ_LtXr1cXepxZmSeiB4qHHK0ofSaZj33H3WpKdgI&usqp=CAU");

            $this->em->persist($newClient);
            $this->em->flush();

            return $this->redirectToRoute('dashboard_clients');
        }
        
        return $this->render('dashboard/clients.html.twig', [
            "clients" => $clients,
            "add_client_form" => $addForm->createView()
        ]);
    }

    /////////////// One client list //////////////////
    #[Route('/client/{id<\d+>}}', name: 'client_show')]
    public function clientShow(int $id, Request $request): Response
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
}