<?php

namespace App\Repository;

use App\Entity\Prix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Prix>
 *
 * @method Prix|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prix|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prix[]    findAll()
 * @method Prix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prix::class);
    }

    public function add(Prix $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Prix $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function searchPrix($billet){
        //fonction midika hoe tedavo ny prix mifandraika @ ty billet ty
        $query = $this->createQueryBuilder('p');
        
        // raha misy valeur ao @ categorie
        if ($billet->getCategorie()){ 
            //join(ampifandraiso@ Categorie za (omeo annarana io fifandraisana io hoe "cat"))
            //categorie izay azo avy @ prix->categorie avadika hoe"p.categorie"
            $query = $query->join('p.Categorie', 'cat')
            /*  ny code eto ambany maneho fa afaka maka id any categorie tsika prix->categorie->id
                efa nahazo alias cat tsika ka au lieu de prix->categorie->id dia "cat.id"
                andWhere(ou(id ny categorie azo ve ao anaty categorie "izay azo avy @ billet"))
                andWhere(cat.it correspond id-cat-billet)
            */
                          ->andWhere('cat.id IN (:categorie)')
                           ->setParameter('categorie',$billet->getCategorie());
        }
        if($billet->getDestination()){
                $query =$query->join('p.destination','dest')
                              ->andWhere('dest.id IN (:destination)')
                              ->setParameter('destination',$billet->getDestination());
        }
        return $query->getQuery()->getResult();
    }

//    /**
//     * @return Prix[] Returns an array of Prix objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Prix
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
