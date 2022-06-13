<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Relations;

class RelationsController extends AbstractController
{
    #[Route('/rel/add', name: 'app_relations_add')]
    public function add(?Relations $relations, Request $request): Response
    {
        $content = json_decode($request->getContent(), true);
        return $this->json([
            'user'  => $content['id']
       ]);
    }

    #[Route('/rel/notification', name: 'app_relations_notif')]
    public function notif(Relations $relations): Response
    {
        return $this->render('relations/index.html.twig', [
            'controller_name' => 'RelationsController',
        ]);
    }

    #[Route('/rel/show', name: 'app_relations_show')]
    public function show(Relations $relations): Response
    {
        return $this->render('relations/index.html.twig', [
            'controller_name' => 'RelationsController',
        ]);
    }
}
