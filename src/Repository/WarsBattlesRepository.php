<?php

namespace App\Repository;

use App\Entity\WarsBattles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WarsBattles|null find($id, $lockMode = null, $lockVersion = null)
 * @method WarsBattles|null findOneBy(array $criteria, array $orderBy = null)
 * @method WarsBattles[]    findAll()
 * @method WarsBattles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WarsBattlesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WarsBattles::class);
    }

    public function save(WarsBattles $region)
    {
        $em = $this->getEntityManager();
        $em->persist($region);
        $em->flush();
    }

    // /**
    //  * @return WarsBattles[] Returns an array of WarsBattles objects
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
    public function findOneBySomeField($value): ?WarsBattles
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
