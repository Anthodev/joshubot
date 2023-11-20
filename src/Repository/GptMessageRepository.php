<?php

namespace App\Repository;

use App\Entity\GptMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GptMessage>
 *
 * @method GptMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method GptMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method GptMessage[]    findAll()
 * @method GptMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GptMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GptMessage::class);
    }

//    /**
//     * @return GptMessage[] Returns an array of GptMessage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GptMessage
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
