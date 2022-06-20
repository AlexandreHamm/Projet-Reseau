<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RelationsRepository;
use App\Entity\Relations;

class RelationsController extends AbstractController
{
    #[Route('/rel/add', name: 'app_relations_add')]
    public function add(Request $request, EntityManagerInterface $entityManager, RelationsRepository $relationsRepository): Response
    {
        $relations = new Relations;
        $content = json_decode($request->getContent(), true);

        // CHECK IF ENTRY ALREADY EXISTS
        $ifExists = $relationsRepository->findOneBy([
            'id_from' => $content['id2'], //$_COOKIE['user'],
            'id_to' => $content['id'],
        ]);
        $ifExists2 = $relationsRepository->findOneBy([
            'id_from' => $content['id'],
            'id_to' => $content['id2'], //$_COOKIE['user'],
        ]);

        if($ifExists == null && $ifExists2 == null){ // ENTRY DOESN'T EXIST, SO WE CAN ADD THE FRIEND REQUEST
            $relations->setIdFrom($content['id2']); //$_COOKIE['user'];
            $relations->setIdTo($content['id']);
            $relations->setStatus($content['status']);
            $relations->setSince(new \DateTime());
        }else if($ifExists != null && $ifExists->getStatus() == 'P' || $ifExists2 != null && $ifExists2->getStatus() == 'P' && $content['status'] != 'B'){ // ENTRY EXISTS AND REQUEST IS PENDING, SO WE CAN ACCEPT THE REQUEST OR BLOCK THE USER
            if($ifExists != null){
                return $this->json([
                    'user'  => 'already added'
                ]);
            }else if($ifExists2 != null){
                $relations = $ifExists2;
            }
            $relations->setStatus('F');
            $relations->setSince(new \DateTime());
        }else if($ifExists != null && $ifExists->getStatus() != 'B' || $ifExists2 != null && $ifExists2->getStatus() != 'B' && $content['status'] == 'B'){ // ENTRY EXISTS SO WE BLOCK THE USER INSTEAD
            if($ifExists != null){
                $relations = $ifExists;
            }else if($ifExists2 != null){
                $relations = $ifExists2;
            }
            $relations->setStatus('B');
            $relations->setSince(new \DateTime());
        }else if($ifExists != null && $ifExists->getStatus() == 'B' || $ifExists2 != null && $ifExists2->getStatus() == 'B'){ // ENTRY EXISTS AND USER IS BLOCKED, SO WE SEND BACK A JSON SAYING USER IS BLOCKED
            return $this->json([
                'user'  => 'blocked'
            ]);
        }

        $entityManager->persist($relations);
        $entityManager->flush();

        return $this->json([
            'user'  => 'added'
        ]);
    }

    #[Route('/rel/del', name: 'app_relations_del')]
    public function del(Request $request, EntityManagerInterface $entityManager, RelationsRepository $relationsRepository): Response
    {
        $relations = new Relations;
        $content = json_decode($request->getContent(), true);

        $ifExists = $relationsRepository->findOneBy([
            'id_from' => $content['id2'], //$_COOKIE['user'],
            'id_to' => $content['id'],
        ]);
        $ifExists2 = $relationsRepository->findOneBy([
            'id_from' => $content['id'],
            'id_to' => $content['id2'], //$_COOKIE['user'],
        ]);

        if($ifExists != null){
            $relations = $ifExists;
        }else if($ifExists2 != null){
            $relations = $ifExists2;
        }else{
            return $this->json([
                'ERROR' => null
            ]);
        }

        $entityManager->remove($relations);
        $entityManager->flush();

        return $this->json([
            'user' => 'removed'
        ]);
    }

    #[Route('/rel/show', name: 'app_relations_show')]
    public function show(Request $request, EntityManagerInterface $entityManager, RelationsRepository $relationsRepository): Response
    {
        $content = json_decode($request->getContent(), true);

        $idFrom = $relationsRepository->findBy([
            'id_from' => $content['id'],
            'status' => 'F',
        ]);
        $idTo = $relationsRepository->findBy([
            'id_to' => $content['id'],
            'status' => 'F',
        ]);

        return $this->json([
            'id_from'  => $idFrom,
            'id_to'  => $idTo
       ]);
    }

    #[Route('/rel/notification', name: 'app_relations_notif')]
    public function notif(Relations $relations): Response
    {
        return $this->render('relations/index.html.twig', [
            'controller_name' => 'RelationsController',
        ]);
    }
}
