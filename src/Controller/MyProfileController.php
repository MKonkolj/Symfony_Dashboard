<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\TaskFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route("/dc7161be3dbf2250c8954e560cc35060", name: "dashboard_")]
class MyProfileController extends AbstractController
{
    private $em;
    public function __construct (EntityManagerInterface $em)
    {
        $this->em = $em;
    }


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


        // generate edit user form
        // handled by the developer controller
        $editUserForm = $this->createForm(RegistrationFormType::class, $profile, [
            'action' => $this->generateUrl('dashboard_developer_show', ["id" => $activeUserId])
        ]);

        return $this->render('dashboard/my-profile.html.twig', [
            "profile" => $profile,
            "tasks" => $tasks,
            "add_task_form" => $form->createView(),
            "form" => $editUserForm->createView()
        ]);
        }
}