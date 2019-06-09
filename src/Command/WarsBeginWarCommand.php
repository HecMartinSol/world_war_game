<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use App\Repository\WarsRepository;
use App\Repository\CountriesWarsRepository;
use App\Repository\CountriesRepository;

use App\Entity\Wars;
use App\Entity\CountriesWars;
use App\Entity\Countries;


class WarsBeginWarCommand extends Command
{
    protected static $defaultName = 'wars:begin-war';

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    public function __construct( WarsRepository $warsRepository, CountriesWarsRepository $countriesWarsRepository, CountriesRepository $countriesRepository )
    {
        $this->warsRepository = $warsRepository;
        $this->countriesWarsRepository = $countriesWarsRepository;
        $this->countriesRepository = $countriesRepository;
        
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $activeWars = $this->warsRepository->getActiveWars();

        if (sizeof($activeWars) == 0) {
            $io->text("Preparando la guerra...");
            $war = new Wars();
            $war->setStartDate(new \DateTime(date("Y-m-d H:i:s")));
            $war->setNumActions(0);
            $this->warsRepository->save($war);
        

            $io->text("Preparando los países contingentes...");
            $countries = $this->countriesRepository->getAllCountries();
            $io->progressStart(sizeof($countries));
            foreach ($countries as $country) {
                $c_war = new CountriesWars();
                $c_war->setCountry($country);
                $c_war->setWar($war);
                $c_war->setConquerer($country);

                $this->countriesWarsRepository->save($c_war);

                $io->progressAdvance();
            }
            
            $io->success("\n\nGuerra creada! [{$war->getId()}]");
        
        } else {

            $io->warning("Ya hay una guerra activa desde {$activeWars[0]->getStartDate()->format('Y-m-d H:i:s')}");
        }



    }
}
