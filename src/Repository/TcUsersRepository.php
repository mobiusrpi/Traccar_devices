<?php

namespace App\Repository;

use App\Entity\TcUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Name>
 */
class TcUsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TcUsers::class);
    }

    public function getDevicesFromUser($userId): array
    {
         return $this->createQuerybuilder('user')
            ->select('user','devices')
            ->leftjoin('user.devices', 'devices')
            ->setParameter('val', $userId)            
            ->andWhere('user.id = :val')
            ->getQuery()
            ->getResult()
        ;
    }

    //    /**
    //     * @return Name[] Returns an array of Name objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('n.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Name
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
