<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Event::class);
    }

//    /**
//     * @return Event[] Returns an array of Event objects
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
    public function findOneBySomeField($value): ?Event
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByName($name)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.name LIKE :name')
            ->setParameter('name', '%'.$name. '%')
            ->getQuery()
            ->getResult()
            ;
    }
    public function futureEvents(): int
    {
        return $this->createQueryBuilder('e')
            ->select('COUNT(e.id)')
            ->andWhere('e.startAt > CURRENT_TIME()')
//            ->andWhere('e.startAt > :now')
//            ->setParameters('now', \DateTime())
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }
    public function getRandom() {
        $stmt = $this->createQueryBuilder('e');
        $stmt->orderBy( 'RAND()' );
        $stmt->setMaxResults( 1 );
        return $stmt->getQuery()->getOneOrNullResult();
    }
}
