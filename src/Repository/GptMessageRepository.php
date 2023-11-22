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

    public function deleteAll(): void
    {
        $this->createQueryBuilder('g')
            ->delete()
            ->getQuery()
            ->execute()
        ;
    }
}
