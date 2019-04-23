<?php

namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class DisponibilityRepository extends EntityRepository
{
    public function findLastParkingId()
    {
        $qb = $this->createQueryBuilder('d');

        $qb = $qb->select('d')
            ->innerJoin('d.parking','p')
            ->where($qb->expr()->eq('d.id', 'p.id'))
            ->orderBy('d.parking', 'DESC');

        $qb->setMaxResults(1);

        $qb->getQuery()->getResult();
    }
}