<?php

namespace App\Controller;

use App\Entity\Specialite;
use App\Form\SpecialiteType;
use App\Repository\SpecialiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpecialiteController extends AbstractController
{
    /**
     * Cette fonction permet d'afficher les specialités
     *
     * @param specialiteRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/specialite', name: 'specialite.index', methods: ['GET'])]
    public function index(SpecialiteRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
            $specialite = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('pages/specialite/index.html.twig', [
            'specialite' => $specialite,
        ]);
    }

    /**
     * cette fonction permet de créer une nouvelle spécialité
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/specialite/nouveau', name: 'specialite.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $specialite = new Specialite();
        $form = $this->createForm(SpecialiteType::class, $specialite,['labelButton' => 'Créer une spécialité']);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $specialite = $form->getData();

            $manager->persist($specialite);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre spécialité a été créé avec succès !'       
            );

            return $this->redirectToRoute('specialite.index');
        }

        return $this->render('pages/specialite/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /**
     * cette fonction permet de modifier une spécialité
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/specialite/edition/{id}', name: 'specialite.edit', methods: ['GET', 'POST'])]
    public function edit(Specialite $specialite, Request $request, EntityManagerInterface $manager): Response
    {
        
        $form = $this->createForm(SpecialiteType::class, $specialite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $specialite = $form->getData();

            $manager->persist($specialite);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre spécialité a été modifiée avec succès !'
            );

            return $this->redirectToRoute('specialite.index');
        }

        return $this->render('pages/specialite/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    

    /**
     * Cette fonction permet de supprimer une specialité
     *
     * @param EntityManagerInterface $manager
     * @param specialite $specialite
     * @return Response
     */
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/specialite/suppression/{id}', name: 'specialite.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Specialite $specialite): Response
    {
       $manager->remove($specialite);
       $manager->flush();
       $this->addFlash(
        'success',
        'Votre spécialité a été supprimée avec succès !'
    );

    return $this->redirectToRoute('specialite.index');

    }
}

