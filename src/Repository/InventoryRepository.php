<?php

namespace App\Repository;

use App\Entity\Inventory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Inventory>
 *
 * @method Inventory|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inventory|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inventory[]    findAll()
 * @method Inventory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InventoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inventory::class);
    }

    public function save(Inventory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Inventory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Inventory[] Returns an array of Inventory objects
    */
   public function findAllVisits($pvs,$du,$au): array
   {
       return $this->createQueryBuilder('i')
           ->andWhere('i.point_vente in (:pvs) and i.date_visite between :du and :au')
           ->setParameter('pvs', $pvs)
           ->setParameter('du', $du)
           ->setParameter('au', $au)
           ->getQuery()
           ->getResult()
       ;
   }

   public function findVisitsByPv($pv,$du,$au): array
   {
       return $this->createQueryBuilder('i')
           ->andWhere('i.point_vente = :pv and i.date_visite between :du and :au')
           ->setParameter('pv', $pv)
           ->setParameter('du', $du)
           ->setParameter('au', $au)
           ->getQuery()
           ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?Inventory
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
