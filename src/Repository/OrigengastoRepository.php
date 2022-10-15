<?php

namespace App\Repository;

use App\Entity\Origengasto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Origengasto>
 *
 * @method Origengasto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Origengasto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Origengasto[]    findAll()
 * @method Origengasto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrigengastoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Origengasto::class);
    }

    public function add(Origengasto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Origengasto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function obtenerQueryOrigenGastos()
    {
        $qb = $this->createQueryBuilder("og");
        return $qb
            ->getQuery();
    }
    //    /**
    //     * @return Origengasto[] Returns an array of Origengasto objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Origengasto
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
