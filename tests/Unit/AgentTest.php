<?php

namespace App\Tests\Unit;

use App\Entity\Agent;
use App\Entity\Nationalite;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AgentTest extends KernelTestCase
{
    public function getEntity(): Agent
    {
        return (new Agent())
            ->setName('Agent')
            ->setFirstName('Agents')
            ->setDateOfBirth(new \DateTime())
            ->setidentificationCode('1234')
            ->setNationalite(new Nationalite());
    }

    public function testEntityIsValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $recipe = $this->getEntity();

        $errors = $container->get('validator')->validate($recipe);

        $this->assertCount(0, $errors);
    }

    public function testInvalidName()
    {
        self::bootKernel();
        $container = static::getContainer();

        $recipe = $this->getEntity();
        $recipe->setName('');

        $errors = $container->get('validator')->validate($recipe);
        $this->assertCount(1, $errors);
    }
}
