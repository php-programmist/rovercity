<?php

namespace App\Repository;

use App\Entity\DobXml;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DobXml|null find($id, $lockMode = null, $lockVersion = null)
 * @method DobXml|null findOneBy(array $criteria, array $orderBy = null)
 * @method DobXml[]    findAll()
 * @method DobXml[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DobXmlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DobXml::class);
    }

    // /**
    //  * @return DobXml[] Returns an array of DobXml objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DobXml
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
