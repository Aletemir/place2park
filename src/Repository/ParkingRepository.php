<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;


class ParkingRepository extends EntityRepository
{
    public function findAllWithPrice(): array
    {
        $qb = $this->createQueryBuilder('p');

        $qb = $qb->select('p')
            ->addSelect('MIN(d.price) AS price')
            ->innerJoin('p.disponibilities', 'd')
            ->where($qb->expr()->gt('d.dateStart', ':now'))
            ->setParameter(':now', new \DateTime());

        $parkings = $qb->getQuery()->getResult();

        $result = [];
        foreach ($parkings as $parking) {
            $parking[0]->price = $parking["price"];
            $result[] = $parking[0];
        }

        return $result;
    }

// TODO : try to join Parkin and Disponibility to get the price

}