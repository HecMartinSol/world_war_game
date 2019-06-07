<?php

namespace App\Repository;

use App\Entity\Wars;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Wars|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wars|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wars[]    findAll()
 * @method Wars[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WarsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Wars::class);
    }

    // /**
    //  * @return Wars[] Returns an array of Wars objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wars
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
