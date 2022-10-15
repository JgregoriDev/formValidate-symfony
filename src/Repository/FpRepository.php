<?php

namespace App\Repository;

use App\Entity\Fp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Fp>
 *
 * @method Fp|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fp|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fp[]    findAll()
 * @method Fp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fp::class);
    }

    public function add(Fp $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Fp $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function obtenerQueryFP()
    {
        $qb=$this->createQueryBuilder("fp");
        return $qb
        ->getQuery()
        ;
    }

//    /**
//     * @return Fp[] Returns an array of Fp objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Fp
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
