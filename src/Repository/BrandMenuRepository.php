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
    protected static $cached_items=[];
    
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BrandMenu::class);
    }
    
    /**
     * @param string $path
     *
     * @return bool
     */
    public function isBrandMenu($path)
    {
        $path = trim($path,' /');
        if (empty(self::$cached_items)) {
            self::$cached_items = $this->findAll();
        }
        foreach (self::$cached_items as $item) {
            if ($item->getAlias() === $path) {
                return true;
            }
        }
    
        return false;
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
