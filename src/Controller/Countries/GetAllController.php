<?php

namespace App\Controller\Countries;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\BusinessService\GuzzleClient;
use App\Entity\Countries;
use App\Entity\Regions;
use App\Entity\Neighbours;

class GetAllController extends AbstractController
{    
    /**
     * @Route("/countries/getall", name="countries_get_all")
     */
    public function index()
    {
        $guzzleClient = new GuzzleClient();
        $entityManager = $this->getDoctrine()->getManager();
        
        $regionsRepo = $entityManager->getRepository(Regions::class);
        $countriesRepo = $entityManager->getRepository(Countries::class);
        $neighboursRepo = $entityManager->getRepository(Neighbours::class);

        $res  = $guzzleClient->get("https://restcountries.eu/rest/v2/all");
        $resArr = json_decode($res, true);

            # var_dump($resArr[0]);
            
        for ($i=0; $i < 5; $i++) { 
            
            foreach ($resArr as $c) {
                $region_name = $c["region"];

                #   Guarda la region si no estuviese
                $region = $regionsRepo->findByName($region_name);
                if (is_null($region)) {
                    $region = new Regions();
                    $region->setName($region_name);
                    
                    $entityManager->persist($region);
                    $entityManager->flush();
                }

                #   Guarda la el país si no estuviese
                $country_name = $c["name"];
                $code = (array_key_exists("alpha3Code", $c) ? $c["alpha3Code"] : (array_key_exists("alpha2Code", $c) ? $c["alpha2Code"] : ""));
                $lat = (isset($c["latlng"][0]) ? $c["latlng"][0] : 0 );
                $lng = (isset($c["latlng"][1]) ? $c["latlng"][1] : 0 );

                $country = $countriesRepo->findByName($country_name);
                if (is_null($country)) {

                    $country = new Countries();
                    $country->setName($c["name"]);
                    $country->setCode($code);
                    $country->setCapital($c["capital"]);
                    $country->setRegionId($region->getId());
                    $country->setArea($c["area"] ?: 0);
                    $country->setLat($lat);
                    $country->setLng($lng);

                    $entityManager->persist($country);
                    $entityManager->flush();
                }

                #   Iteramos los borders y los almacenamos
                foreach ($c["borders"] as $border_code) {
                    $country2 = $countriesRepo->findBycode($border_code);

                    if ( !is_null($country2) && 
                         !$neighboursRepo->areNeighbours($country->getId(), $country2->getId()) && 
                         !$neighboursRepo->areNeighbours($country2->getId(), $country->getId()) 
                     ){
                        $neighbours = new Neighbours();
                        $neighbours->setCountry1($country);
                        $neighbours->setCountry2($country2);

                        $entityManager->persist($neighbours);
                        $entityManager->flush();
                    }
                }

            }
        }

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CountriesGetAllController.php',
        ], 200, ["Content-type: text/json"]);
    }
}
