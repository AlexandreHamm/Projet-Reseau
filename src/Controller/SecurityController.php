<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
// use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/api/login', name: 'app_login')]
    // public function login(AuthenticationUtils $authenticationUtils): Response
    public function index(?User $user): Response
    {
        if ($user === null) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        
        $user = $this->getUser();

        setcookie('logged', true, time()+604800,httponly:true);
        // setcookie('id', '', time()+604800,httponly:true);

        return $this->json([
             'userLoggedIn'  => true
        ]);
    }

    #[Route('/api/verif', name: 'app_verif')]
    public function verif(): Response
    {
        if($_COOKIE['logged'] === true){
            return $this->json([
                'userLoggedIn'  => true
            ]);
        }else{
            return $this->json([
                'userLoggedIn'  => false
            ]);
        }
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
