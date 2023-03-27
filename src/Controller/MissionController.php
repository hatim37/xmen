<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\MissionType;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionController extends AbstractController
{
       /**
     * Cette fonction permet d'afficher les missions
     *
     * @param missionRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/mission', name: 'mission.index', methods: ['GET'])]
    public function index(MissionRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
            $mission = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('pages/mission/index.html.twig', [
            'mission' => $mission,
        ]);
    }

    /**
     * cette fonction permet de créer une nouvelle mission
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/mission/nouveau', name: 'mission.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
       
        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission);

        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mission = $form->getData();

           $manager->persist($mission);
           $manager->flush();

           $this->addFlash(
               'success',
               'Votre mission a été créé avec succès !'       
           );

           return $this->redirectToRoute('mission.index');
        }

        return $this->render('pages/mission/new.html.twig', [
            'form' => $form->createView()
            
        ]
    );
    }

     /**
     * cette fonction permet de modifier une mission
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/mission/edition/{id}', name: 'mission.edit', methods: ['GET', 'POST'])]
    public function edit(Mission $mission, Request $request, EntityManagerInterface $manager): Response
    {
        
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mission = $form->getData();

           $manager->persist($mission);
           $manager->flush();

           $this->addFlash(
               'success',
               'Votre mission a été modifié avec succès !'
           );

           return $this->redirectToRoute('mission.index');
        }

        return $this->render('pages/mission/edit.html.twig', [
            'form' => $form->createView()
            
        ]);
    }

    

    /**
     * Cette fonction permet de supprimer une mission
     *
     * @param EntityManagerInterface $manager
     * @param mission $mission
     * @return Response
     */
    #[Route('/mission/suppression/{id}', name: 'mission.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Mission $mission): Response
    {
       $manager->remove($mission);
       $manager->flush();
       $this->addFlash(
        'success',
        'Votre mission a été supprimé avec succès !'
    );

    return $this->redirectToRoute('mission.index');

    }

    #[Route('/mission/{id}', name: 'mission.show', methods: ['GET'])]
    public function show(MissionRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
            $mission = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('pages/mission/index.html.twig', [
            'mission' => $mission,
        ]);
    }
}

