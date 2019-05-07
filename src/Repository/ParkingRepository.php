<?php

namespace App\Repository;

use DateTime;
use Doctrine\ORM\EntityRepository;


class ParkingRepository extends EntityRepository
{
//    allow to get the price of parkings
    public function findAllWithPrice(): array
    {
        $qb = $this->createQueryBuilder('p');

        $qb = $qb->select('p')->addSelect('MIN(d.price) AS price')
            ->innerJoin('p.disponibilities', 'd')
            ->where($qb->expr()->gt('d.dateEnd', ':now'))
            ->orderBy('p.createdAt', 'DESC')
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

    public function findParkingFromUserreservation(): array
    {
        $qb = $this->createQueryBuilder('p');

        $qb = $qb ->select('p', 'd', 'r', 'u')
            ->innerJoin('p.disponibilities', 'd')
            ->innerJoin('d.reservation', 'r')
            ->innerJoin('r.user', 'u')
            ->where($qb->expr()->eq('p.id', 'd.parking'))
            ->andWhere($qb->expr()->eq('d.reservation', 'r.id'))
            ->andwhere($qb->expr()->eq('r.user', 'u.id'));

        return $qb->getQuery()->getResult();
    }


}