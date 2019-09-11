<?php

namespace App\Repository;

use App\Entity\BrandMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BrandMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method BrandMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method BrandMenu[]    findAll()
 * @method BrandMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrandMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BrandMenu::class);
    }

    // /**
    //  * @return BrandMenu[] Returns an array of BrandMenu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BrandMenu
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
