<?php

namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class DisponibilityRepository extends EntityRepository
{
    public function findDisponibiliityByParking(): array
    {
        $qb = $this->createQueryBuilder('d');

        $qb = $qb->select('d')
            ->innerJoin('d.parking', 'p')
            ->where($qb->expr()->eq('d.parking', ':parking'))
            ->setParameter(':parking', 'p.id');

        return $qb->getQuery()->getResult();
    }
}