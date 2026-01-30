<?php

namespace App\Command;

use App\Entity\Batiment;
use App\Entity\Personne;
use Doctrine\ORM\EntityManagerInterface;
use Person;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Faker\Factory;

#[AsCommand(
    name: 'InsertData',
    description: 'Add a short description for your command',
)]
class InsertDataCommand extends Command
{
    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure(): void {}

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
         $faker = Factory::create();
        $io = new SymfonyStyle($input, $output);

        $person = new Personne();
        $batiment = new Batiment();

        for ($i = 0; $i < 10; $i++) {
            $person->setPrenom($faker->name());
            $batiment->setNom($faker->name());
            $batiment->setAdresse(adresse: $faker->address());
            $person->setBatiment($batiment);
            $this->em->persist($batiment);
            $this->em->persist($person);
        }
        $this->em->flush();



        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
