<?php

namespace App\Repository;

use App\Entity\Persontransport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Persontransport>
 *
 * @method Persontransport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Persontransport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Persontransport[]    findAll()
 * @method Persontransport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersontransportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Persontransport::class);
    }

    //    /**
    //     * @return Persontransport[] Returns an array of Persontransport objects
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

    //    public function findOneBySomeField($value): ?Persontransport
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
