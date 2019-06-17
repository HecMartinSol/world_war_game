<?php

namespace App\Repository;

use App\Entity\CountriesWars;
use App\Entity\Wars;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CountriesWars|null find($id, $lockMode = null, $lockVersion = null)
 * @method CountriesWars|null findOneBy(array $criteria, array $orderBy = null)
 * @method CountriesWars[]    findAll()
 * @method CountriesWars[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountriesWarsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CountriesWars::class);
    }

    public function save(CountriesWars $entity)
    {
        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }

    public function getRandomCountryInWar(Wars $war)
    {
        $countries_in_war = $this->findBy(["war"=> $war]);

        $rand_i = rand(0, sizeof($countries_in_war)-1);

        return $countries_in_war[$rand_i];

    }

    public function getCountriesConqueredBy($conquerer)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.conquerer = :conquerer')
            ->setParameter('conquerer', $conquerer)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return CountriesWars[] Returns an array of CountriesWars objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CountriesWars
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
