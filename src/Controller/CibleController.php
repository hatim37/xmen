<?php

namespace App\Controller;

use App\Entity\Cible;
use App\Form\CibleType;
use App\Repository\CibleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CibleController extends AbstractController
{
    /**
     * cette fonction permet d'afficher le cible
     *
     * @param CibleRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/cible', name: 'cible.index', methods: ['GET'])]
    public function index(CibleRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
            $cible = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('pages/cible/index.html.twig', [
            'cible' => $cible,
        ]);
    }

    /**
     * cette fonction permet de créer une nouvelle cible
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/cible/nouveau', name: 'cible.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $cible = new Cible();
        $form = $this->createForm(CibleType::class, $cible);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cible = $form->getData();

            $manager->persist($cible);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre cible a été créé avec succès !'       
            );

            return $this->redirectToRoute('cible.index');
        }

        return $this->render('pages/cible/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /**
     * cette fonction permet de modifier une cible
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/cible/edition/{id}', name: 'cible.edit', methods: ['GET', 'POST'])]
    public function edit(Cible $cible, Request $request, EntityManagerInterface $manager): Response
    {
        
        $form = $this->createForm(CibleType::class, $cible);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cible = $form->getData();

            $manager->persist($cible);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre cible a été modifié avec succès !'
            );

            return $this->redirectToRoute('cible.index');
        }

        return $this->render('pages/cible/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * cette fonction permet de supprimer une cible
     *
     * @param EntityManagerInterface $manager
     * @param Cible $cible
     * @return Response
     */
    #[Route('/cible/suppression/{id}', name: 'cible.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Cible $cible): Response
    {
       $manager->remove($cible);
       $manager->flush();
       $this->addFlash(
        'success',
        'Votre cible a été supprimé avec succès !'
    );

    return $this->redirectToRoute('cible.index');

    }
}