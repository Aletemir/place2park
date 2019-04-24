<?php

namespace App\Repository;

use App\Entity\Parking;
use DateTime;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


class ParkingRepository extends EntityRepository
{
//    allow to get the price of parkings
    public function findAllWithPrice(): array
    {
        $qb = $this->createQueryBuilder('p');

        $qb = $qb->select('p')
            ->addSelect('MIN(d.price) AS price')
            ->innerJoin('p.disponibilities', 'd')
            ->where($qb->expr()->gt('d.dateStart', ':now'))
            ->groupBy('p.id')
            ->setParameter(':now', new DateTime());

        $parkings = $qb->getQuery()->getResult();

        $result = [];
        foreach ($parkings as $parking) {
            $parking[0]->price = $parking["price"];
            $result[] = $parking[0];
        }

        return $result;
    }

    public function findOneParkById()
    {
        $qb = $this->createQueryBuilder('p');

        $qb = $qb->select('p')
            ->innerJoin('p.disponibilities', 'd')
            ->where($qb->expr()->eq('p.id', ':parking'));

        return $qb->getQuery()->getResult();
    }
}
