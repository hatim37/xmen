<?php

namespace App\Tests\Fonctional;

use App\Entity\Agent;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AgentTest extends WebTestCase
{
    public function testIfCreateIngredientIsSuccessfull(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);

        $client->loginUser($user);

        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('agent.new'));

        $form = $crawler->filter('form[name=agent]')->form([
            'agent[name]' => "NewAgent",
            'agent[firstName]' => 'AgentName',
            'agent[dateOfBirth]' => "2023-02-02",
            'agent[identificationCode]' => 1145,
            'agent[nationalite]' => "3",
            'agent[specialite]' => ["4"]
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert-success', 'Votre agent a été crée avec succès !');

        $this->assertRouteSame('agent.index');
    }

    public function testIfListingredientIsSuccessful(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);

        $client->loginUser($user);

        $client->request(Request::METHOD_GET, $urlGenerator->generate('agent.index'));

        $this->assertResponseIsSuccessful();

        $this->assertRouteSame('agent.index');
    }

    public function testIfUpdateAnIngredientIsSuccessfull(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);
        $agent = $entityManager->getRepository(Agent::class)->find(3);


        $client->loginUser($user);

        $crawler = $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('agent.edit', ['id' => $agent->getId()])
        );

        $this->assertResponseIsSuccessful();

        $form = $crawler->filter('form[name=agent]')->form([
            'agent[name]' => "NewAgent#",
            'agent[firstName]' => 'AgentName#',
            'agent[dateOfBirth]' => "2023-02-02",
            'agent[identificationCode]' => 1515,
            'agent[nationalite]' => "3",
            'agent[specialite]' => ["3"]
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert-success', 'Votre agent a été modifié avec succès !');

        $this->assertRouteSame('agent.index');
    }

    public function testIfDeleteAnIngredientIsSuccessful(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);
        $agent = $entityManager->getRepository(Agent::class)->find(8);

        $client->loginUser($user);

        $crawler = $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('agent.delete', ['id' => $agent->getId()])
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert-success', 'Votre agent a été supprimé avec succès !');

        $this->assertRouteSame('agent.index');
    }
}
