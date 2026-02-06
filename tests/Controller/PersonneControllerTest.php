<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

final class PersonneControllerTest extends WebTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $kernel = static::createKernel();
        $kernel->boot();

        $application = new Application($kernel);
        $application->setAutoExit(false);

        // Create the database schema
        $input = new ArrayInput([
            'command' => 'doctrine:schema:create',
        ]);
        $output = new BufferedOutput();
        $application->run($input, $output);
    }

    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/personne');

        self::assertResponseIsSuccessful();
    }
}
