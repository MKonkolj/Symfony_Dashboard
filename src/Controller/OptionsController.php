<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Task;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/dc7161be3dbf2250c8954e560cc35060", name: "dashboard_")]
class DashboardController extends AbstractController
{
    private $em;
    public function __construct (EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /////////////// delete route //////////////////
    #[Route('/{route}/delete/{id}', name: 'delete', methods: ["GET", "DELETE"])]
    public function delete($route, $id): Response
    {   
        // provera iz koje tabele brišemo podatke
        // i prilagođavanje ruta varijabile za kasnije preusmeravanje
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