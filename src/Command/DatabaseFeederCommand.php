<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use App\BusinessService\GuzzleClient;
use App\Entity\Countries;
use App\Repository\RegionsRepository;
use App\Entity\Regions;

class DatabaseFeederCommand extends Command
{
    protected static $defaultName = 'database-feeder';

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /*
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
        */

        $guzzleClient = new GuzzleClient();
        # $entityManager = $this->getDoctrine()->getManager();
        $cr = RegionsRepository::findByByName("Asia");
        var_dump($cr);

        $res  = $guzzleClient->get("https://restcountries.eu/rest/v2/all");
        $resArr = json_decode($res, true);

            var_dump($resArr[0]);
            

        foreach ($resArr as $c) {
            $region_name = $c["region"];
            echo "$region_name \n";
            /**


            $country = new Countries();
            $country->setName($c["name"]);
            $country->setCode($c["alpha3code"]);
            $country->setCapital($c["capital"]);
            $country->setRegionId($region->getId());
            $country->setArea($c["name"]);
            $country->setLat($c["name"]);
            $country->setLng($c["name"]);


            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($country);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
            */
        }

    }
}
