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
use App\Repository\NeighboursRepository;
use App\Repository\WarsBattlesRepository;

use App\Entity\Wars;
use App\Entity\CountriesWars;
use App\Entity\Countries;
use App\Entity\Neighbours;
use App\Entity\WarsBattles;

class WarsMakeBattleCommand extends Command
{
    protected static $defaultName = 'wars:make-battle';

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    public function __construct( 
        WarsRepository $warsRepository,
        CountriesWarsRepository $countriesWarsRepository,
        CountriesRepository $countriesRepository ,
        NeighboursRepository $neighboursRepository,
        WarsBattlesRepository $warsBattlesRepository 
    )
    {
        $this->warsRepository = $warsRepository;
        $this->countriesWarsRepository = $countriesWarsRepository;
        $this->countriesRepository = $countriesRepository;
        $this->neighboursRepository = $neighboursRepository;
        $this->warsBattlesRepository = $warsBattlesRepository;
        
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);


        $activeWars = $this->warsRepository->getActiveWars();
        if (sizeof($activeWars) == 0)
            $io->error("No estamos en guerra...");

        $war = $activeWars[0]; 

        $battle_finished = false;
        do{
            
            #   Obtiene un país de manera aleatoria
            $country_in_war = $this->countriesWarsRepository->getRandomCountryInWar($war);

            #   Obtiene el país que posee ese país
            $country_conquerer = $country_in_war->getConquerer();

            #   Obtiene todos los países conquistados por él
            $countries_conquered = $this->countriesWarsRepository->getCountriesConqueredBy($country_conquerer);

            echo sizeof($countries_conquered);

            /**
            $attacker_country = $country_in_war->getConquerer();

            $neighbours = $this->neighboursRepository->findBy(["country_1" => $attacker_country]);
            if (sizeof($neighbours) == 0) {
                $neighbours = $this->neighboursRepository->findBy(["country_2" => $attacker_country]);
                $alt = true;
            } else {
                $alt = false;
            }

            if (sizeof($neighbours) == 0) continue;
            
            $io->text("El país atacante es {$attacker_country->getName()}");

            $method = ($alt ? "getCountry1" : "getCountry2");
            $defender_country = $neighbours[rand(0, sizeof($neighbours)-1)]->{$method}();

            $io->text("El país defensor es {$defender_country->getName()}");

            $winner = rand(0,1) ? "atacante" : "defensor";
            $winner_country = ($winner == "atacante" ? $attacker_country : $defender_country);
            $looser_country = ($winner == "atacante" ? $defender_country : $attacker_country);

            $io->text("Gana el país $winner");

            $battle = new WarsBattles();
            $battle->setWar($war);
            $battle->setCountryAttacker($attacker_country);
            $battle->setCountryDefender($defender_country);
            $battle->setCountryWinner($winner_country);
            $battle->setPoints(round($looser_country->getArea()));
            $battle->setBattleDate(new \DateTime(date("Y-m-d H:i:s")));
            $this->warsBattlesRepository->save($battle);

            */
            $battle_finished = true;
            
        } while (!$battle_finished);

        $io->success("Batalla terminada");
    }
}
