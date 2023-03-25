<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * Cette fonction permet d'afficher les contacts
     *
     * @param contactRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/contact', name: 'contact.index', methods: ['GET'])]
    public function index(ContactRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
            $contact = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('pages/contact/index.html.twig', [
            'contact' => $contact,
        ]);
    }

    /**
     * cette fonction permet de créer un nouveau contact
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/contact/nouveau', name: 'contact.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre contact a été créé avec succès !'       
            );

            return $this->redirectToRoute('contact.index');
        }

        return $this->render('pages/contact/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /**
     * cette fonction permet de modifier un contact
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/contact/edition/{id}', name: 'contact.edit', methods: ['GET', 'POST'])]
    public function edit(Contact $contact, Request $request, EntityManagerInterface $manager): Response
    {
        
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre contact a été modifié avec succès !'
            );

            return $this->redirectToRoute('contact.index');
        }

        return $this->render('pages/contact/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Cette fonction permet de supprimer un contact
     *
     * @param EntityManagerInterface $manager
     * @param Contact $contact
     * @return Response
     */
    #[Route('/contact/suppression/{id}', name: 'contact.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Contact $contact): Response
    {
       $manager->remove($contact);
       $manager->flush();
       $this->addFlash(
        'success',
        'Votre contact a été supprimé avec succès !'
    );

    return $this->redirectToRoute('contact.index');

    }
}
