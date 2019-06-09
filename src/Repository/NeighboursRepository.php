<?php

namespace App\Repository;

use App\Entity\Neighbours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Neighbours|null find($id, $lockMode = null, $lockVersion = null)
 * @method Neighbours|null findOneBy(array $criteria, array $orderBy = null)
 * @method Neighbours[]    findAll()
 * @method Neighbours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NeighboursRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Neighbours::class);
    }

    public function save(Neighbours $entity)
    {
        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }

    public function areNeighbours($country_1, $country_2)
    {
        return  !is_null($this->createQueryBuilder('neighbours')
                    ->andWhere('neighbours.country_1 = :country_1')
                    ->andWhere('neighbours.country_2 = :country_2')
                    ->setParameter('country_1', $country_1)
                    ->setParameter('country_2', $country_2)
                    ->getQuery()
                    ->getOneOrNullResult());
        ;
    }

    // /**
    //  * @return Neighbours[] Returns an array of Neighbours objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Neighbours
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
