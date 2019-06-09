<?php

namespace App\Repository;

use App\Entity\Regions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Regions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Regions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Regions[]    findAll()
 * @method Regions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegionsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Regions::class);
    }

    public function save(Regions $region)
    {
        $em = $this->getEntityManager();
        $em->persist($region);
        $em->flush();
    }

    public function findByName($name)
    {
        return $this->createQueryBuilder('regions')
            ->andWhere('regions.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    // /**
    //  * @return Regions[] Returns an array of Regions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Regions
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
