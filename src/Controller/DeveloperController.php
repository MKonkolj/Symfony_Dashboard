<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/dc7161be3dbf2250c8954e560cc35060", name: "dashboard_")]
class DeveloperController extends AbstractController
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

        
        // create add developer form
        // this form is handled by RegistrationController
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
    public function developerShow($id, Request $request): Response
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

        // generate edit form
        $form = $this->createForm(RegistrationFormType::class, $developer);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $developer = $form->getData();

            // proveriti stari pass sa isValid()
            // ako je tačan uneti novi password iz drugog inputa
            // hashovati novi pass pre unosa u db

            $developerRepo->add($developer);

            return $this->redirectToRoute("dashboard_developer_show", ["id" => $id]);
        }

        return $this->render('dashboard/developer-show.html.twig', [
            "developer" => $developer,
            "tasks" => $tasks,
            "form" => $form->createView()
        ]);
    }
}