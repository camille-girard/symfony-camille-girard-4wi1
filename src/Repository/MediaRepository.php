<?php

namespace App\Repository;

use App\Entity\Media;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Media::class);
    }

    public function findPopular(): array
    {
        return $this->createQueryBuilder('m')
            ->select('m')
            ->leftJoin('m.watchHistories', 'wh')
            ->groupBy('m.id')
            ->orderBy('COUNT(wh.id)', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
}
