<?php

namespace App\Controller;

use App\Entity\Planque;
use App\Form\PlanqueType;
use App\Repository\PlanqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanqueController extends AbstractController
{
    /**
     * Cette fonction permet d'afficher toutes les planques
     *
     * @param planqueRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/planque', name: 'planque.index', methods: ['GET'])]
    public function index( PlanqueRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
            $planque = $paginator->paginate(
            $repository->findAll(),
             /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );


        return $this->render('pages/planque/index.html.twig', [
            'planque' => $planque,
        ]);
    }


    /**
     * cette fonction permet de créer une nouvelle planque
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/planque/nouveau', name: 'planque.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $planque = new Planque();
        $form = $this->createForm(PlanqueType::class, $planque,['labelButton' => 'Créer une mission']);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $planque = $form->getData();

            $manager->persist($planque);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre planque a été créé avec succès !'       
            );

            return $this->redirectToRoute('planque.index');
        }

        return $this->render('pages/planque/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /**
     * cette fonction permet de modifier une planque
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/planque/edition/{id}', name: 'planque.edit', methods: ['GET', 'POST'])]
    public function edit(Planque $planque, Request $request, EntityManagerInterface $manager): Response
    {
        
        $form = $this->createForm(PlanqueType::class, $planque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planque = $form->getData();

            $manager->persist($planque);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre planque a été modifié avec succès !'
            );

            return $this->redirectToRoute('planque.index');
        }

        return $this->render('pages/planque/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Cette fonction permet de supprimer une planque
     *
     * @param EntityManagerInterface $manager
     * @param planque $planque
     * @return Response
     */
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/planque/suppression/{id}', name: 'planque.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, planque $planque): Response
    {
       $manager->remove($planque);
       $manager->flush();
       $this->addFlash(
        'success',
        'Votre planque a été supprimé avec succès !'
    );

    return $this->redirectToRoute('planque.index');

    }
}

