<?php

namespace App\Repository;

use App\Entity\TableUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TableUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method TableUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method TableUser[]    findAll()
 * @method TableUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TableUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TableUser::class);
    }

//    /**
//     * @return TableUser[] Returns an array of TableUser objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TableUser
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
