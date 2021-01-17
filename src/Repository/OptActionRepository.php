<?php

namespace App\Repository;

use App\Entity\OptAction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OptAction|null find($id, $lockMode = null, $lockVersion = null)
 * @method OptAction|null findOneBy(array $criteria, array $orderBy = null)
 * @method OptAction[]    findAll()
 * @method OptAction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptActionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OptAction::class);
    }

//    /**
//     * @return OptAction[] Returns an array of OptAction objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OptAction
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
