<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Event\LogoutEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

use Symfony\Component\HttpFoundation\RequestStack;

class SecurityController extends AbstractController
{
    #[Route('/api/security', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route('/api/verif', name: 'app_verif')]
    public function verif(): Response
    {
        $user = $this->getUser();
        return $this->json([
            'userLoggedIn'  => $user != null
        ]);
    }

    #[Route('/old/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/logout', name: 'api_logout')]
    public function APILogout(Request $request,
    EventDispatcherInterface $eventDispatcher,
    TokenStorageInterface $tokenStorage
    ) : Response
{

    $logoutEvent = new LogoutEvent($request, $tokenStorage->getToken());
    $eventDispatcher->dispatch($logoutEvent);
    $tokenStorage->setToken(null);

    return $this->json(
        $tokenStorage
    );
    }
}
