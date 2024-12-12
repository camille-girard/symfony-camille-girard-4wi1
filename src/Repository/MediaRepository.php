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

    /**
     * Récupérer les films les plus populaires en fonction du nombre de visionnages
     */
    public function findPopular(): array
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.watchHistories', 'w')
            ->groupBy('m.id')
            ->orderBy('COUNT(w.id)', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

}
