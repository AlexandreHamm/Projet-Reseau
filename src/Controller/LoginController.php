<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class LoginController extends AbstractController
{

#[Route('/api/login', name: 'api_login')]
    public function index(?User $user): Response
    {
        if ($user === null) {
            $this->json([
                'message' => 'ERROR IN USERNAME OR PASSWORD',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = $this->getUser();
    
        return $this->json([
             'userLoggedIn'  => true
        ]);
    }
}