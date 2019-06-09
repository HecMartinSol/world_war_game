<?php

namespace App\Repository;

use App\Entity\Countries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Countries|null find($id, $lockMode = null, $lockVersion = null)
 * @method Countries|null findOneBy(array $criteria, array $orderBy = null)
 * @method Countries[]    findAll()
 * @method Countries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountriesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Countries::class);
    }

    public function save(Countries $region)
    {
        $em = $this->getEntityManager();
        $em->persist($region);
        $em->flush();
    }

    public function findByName($name)
    {
        return $this->createQueryBuilder('countries')
            ->andWhere('countries.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function findByCode($code)
    {
        return $this->createQueryBuilder('countries')
            ->andWhere('countries.code = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Countries
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
