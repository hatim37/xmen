<?php

namespace App\Tests\Fonctional;

use App\Entity\Specialite;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class specialiteTest extends WebTestCase
{
    
    public function testIfCreateSpecialiteIsSuccessfull(): void
    {
        

        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);

        $client->loginUser($user);

        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('specialite.new'));
        
        $form = $crawler->filter('form[name=specialite]')->form([
            'specialite[name]' => "Spécialité"
        ]);
        
        $client->submit($form);
        
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();
       
        $this->assertSelectorTextContains('div.alert-success', 'Votre spécialité a été créé avec succès !');

        $this->assertRouteSame('specialite.index');
    }

    public function testIfListSpecialiteIsSuccessful(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);

        $client->loginUser($user);

        $client->request(Request::METHOD_GET, $urlGenerator->generate('specialite.index'));

        $this->assertResponseIsSuccessful();

        $this->assertRouteSame('specialite.index');
    }

    public function testIfUpdateAnSpecialiteIsSuccessfull(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);
        $specialite = $entityManager->getRepository(Specialite::class)->find(7);
        

        $client->loginUser($user);

        $crawler = $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('specialite.edit', ['id' => $specialite->getId()])
        );

        $this->assertResponseIsSuccessful();

        $form = $crawler->filter('form[name=specialite]')->form([
            'specialite[name]' => "Spécialité#"
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert-success', 'Votre spécialité a été modifiée avec succès !');

        $this->assertRouteSame('specialite.index');
    }

    public function testIfDeleteAnSpecialiteIsSuccessful(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 1);
        $specialite = $entityManager->getRepository(Specialite::class)->find(21);

        $client->loginUser($user);

        $crawler = $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('specialite.delete', ['id' => $specialite->getId()])
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains('div.alert-success', 'Votre spécialité a été supprimée avec succès !');

        $this->assertRouteSame('specialite.index');
    }
   
}