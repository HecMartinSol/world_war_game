<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use Symfony\Component\DependencyInjection\EntityManagerInterface;

use App\BusinessService\GuzzleClient;
use App\Repository\RegionsRepository;
use App\Repository\CountriesRepository;
use App\Repository\NeighboursRepository;

use App\Entity\Regions;
use App\Entity\Countries;
use App\Entity\Neighbours;

class DatabaseFeederCommand extends Command
{
    protected static $defaultName = 'database:feeder';

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    public function __construct( GuzzleClient $guzzleClient, RegionsRepository $regionsRepository, CountriesRepository $countriesRepository, NeighboursRepository $neighboursRepository )
    {
        $this->guzzleClient = $guzzleClient;
        $this->regionsRepository = $regionsRepository;
        $this->countriesRepository = $countriesRepository;
        $this->neighboursRepository = $neighboursRepository;

        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        /**
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
        */

        $io->title("Cargando regiones, países y vecinos");
        
        $urlCountries = "https://restcountries.eu/rest/v2/all";
        
        $io->writeln("Obteniendo datos de $urlCountries");
        $res  = $this->guzzleClient->get($urlCountries);
        $resArr = json_decode($res, true);

        $io->writeln("ok");

        for ($i=0; $i < 5; $i++) { 
            $io->section("Iteración $i");

            $io->progressStart(sizeof($resArr));
            foreach ($resArr as $c) {
                $region_name = $c["region"];

                #   Guarda la region si no estuviese
                $region = $this->regionsRepository->findByName($region_name);
                if (is_null($region)) {
                    # $io->writeln("Guardando region [$region_name]");

                    $region = new Regions();
                    $region->setName($region_name);
                    
                    $this->regionsRepository->save($region);
                }

                #   Guarda la el país si no estuviese
                $country_name = $c["name"];
                $code = (array_key_exists("alpha3Code", $c) ? $c["alpha3Code"] : (array_key_exists("alpha2Code", $c) ? $c["alpha2Code"] : ""));
                $lat = (isset($c["latlng"][0]) ? $c["latlng"][0] : 0 );
                $lng = (isset($c["latlng"][1]) ? $c["latlng"][1] : 0 );

                $country = $this->countriesRepository->findByName($country_name);
                if (is_null($country)) {
                    # $io->writeln("Guardando país [$country_name]");

                    $country = new Countries();
                    $country->setName($country_name);
                    $country->setCode($code);
                    $country->setCapital($c["capital"]);
                    $country->setRegionId($region->getId());
                    $country->setArea($c["area"] ?: 0);
                    $country->setLat($lat);
                    $country->setLng($lng);

                    $this->countriesRepository->save($country);
                }

                #   Iteramos los borders y los almacenamos
                foreach ($c["borders"] as $border_code) {
                    $country2 = $this->countriesRepository->findBycode($border_code);

                    if ( !is_null($country2) && 
                         !$this->neighboursRepository->areNeighbours($country->getId(), $country2->getId()) && 
                         !$this->neighboursRepository->areNeighbours($country2->getId(), $country->getId()) 
                     ){
                        # $io->writeln("Guardando vecinos [{$country->getName()} - {$country2->getName()}]");

                        $neighbours = new Neighbours();
                        $neighbours->setCountry1($country);
                        $neighbours->setCountry2($country2);

                        $this->neighboursRepository->save($neighbours);
                    }
                }

                $io->progressAdvance();
            }
            $io->writeln("\n\n");
        }

        $io->success("Regiones, Países y vecinos almacenados");

    }
}
