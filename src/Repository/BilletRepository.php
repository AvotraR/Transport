<?php

namespace App\Repository;

use App\Entity\Billet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Billet>
 *
 * @method Billet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Billet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Billet[]    findAll()
 * @method Billet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BilletRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Billet::class);
    }

    public function add(Billet $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Billet $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function existeDeja($reservation){
        return $this->createQueryBuilder('b')
                   ->andWhere('b.place = :place')
                   ->andWhere('b.DateReservation = :DateReservation')
                   ->setParameter('place', $reservation->getPlace())
                   ->setParameter('DateReservation', $reservation->getDateReservation())
                   ->getQuery()
                   ->getResult()
               ;
    }

//    /**
//     * @return Billet[] Returns an array of Billet objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Billet
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
