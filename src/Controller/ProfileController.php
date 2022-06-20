<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function show(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $content = json_decode($request->getContent(), true);
        $user = $userRepository->findOneBy([
            'username' => $content['name']
        ]);

        return $this->json([
            'user' => $user
        ]);
    }
}
