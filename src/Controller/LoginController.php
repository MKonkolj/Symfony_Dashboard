<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route("/dc7161be3dbf2250c8954e560cc35060", name: "dashboard_")]
class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(AuthenticationUtils $auth): Response
    {
        if($this->getUser())
            return $this->redirectToRoute('dashboard_developers');

        $error = $auth->getLastAuthenticationError();
        return $this->render("login/index.html.twig", [
            "error" => $error
        ]);
    }

    #[Route('/forgotten-password', name: 'forgotten-password')]
    public function forgottenPassword(): Response
    {
        // $sendMail = mail("mladenkonkolj@gmail.com", "PHP test", "Testiranje php mail funkcije");
        // if (!$sendMail) {
        //     $errorMessage = error_get_last()['message'];
        //     return new Response($errorMessage);
        // }

        return new Response("Poslat mejl uspešno");
    }
}
