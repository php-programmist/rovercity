<?php

namespace App\Repository;

use App\Entity\ImagesMeta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ImagesMeta|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImagesMeta|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImagesMeta[]    findAll()
 * @method ImagesMeta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImagesMetaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImagesMeta::class);
    }

    // /**
    //  * @return ImagesMeta[] Returns an array of ImagesMeta objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImagesMeta
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
