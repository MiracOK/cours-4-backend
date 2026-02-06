<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PersonneControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();

        // Créer le schéma de base de données en mémoire pour les tests
        $container = static::getContainer();
        $entityManager = $container->get('doctrine')->getManager();

        $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);
        $metadata = $entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool->createSchema($metadata);

        $client->request('GET', '/personne');

        self::assertResponseIsSuccessful();
    }
}
