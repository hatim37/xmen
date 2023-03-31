<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Form\AgentType;
use App\Repository\AgentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgentController extends AbstractController
{
    /**
     * Cette fonction affiche tous les agent
     *
     * @param agentRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/agent', name: 'agent.index', methods: ['GET'])]
    public function index(AgentRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $agent = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('pages/agent/index.html.twig', [
            'agent' => $agent,
        ]);
    }

    /**
     * cette fonction permet de créer un nouveau agent
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/agent/nouveau', name: 'agent.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $agent = new Agent();
        $form = $this->createForm(AgentType::class, $agent, ['labelButton' => 'Créer un agent']);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $agent = $form->getData();

            $manager->persist($agent);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre agent a été crée avec succès !'
            );

            return $this->redirectToRoute('agent.index');
        }

        return $this->render('pages/agent/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /**
     * cette fonction permet de modifier un agent
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/agent/edition/{id}', name: 'agent.edit', methods: ['GET', 'POST'])]
    public function edit(Agent $agent, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(agentType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $agent = $form->getData();

            $manager->persist($agent);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre agent a été modifié avec succès !'
            );

            return $this->redirectToRoute('agent.index');
        }

        return $this->render('pages/agent/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }



    /**
     * Cette fonction permet de supprimer un agent
     *
     * @param EntityManagerInterface $manager
     * @param Agent $agent
     * @return Response
     */
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/agent/suppression/{id}', name: 'agent.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Agent $agent): Response
    {
        $manager->remove($agent);
        $manager->flush();
        $this->addFlash(
            'success',
            'Votre agent a été supprimé avec succès !'
        );

        return $this->redirectToRoute('agent.index');
    }
}
