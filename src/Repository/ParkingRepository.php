<?php


namespace App\Repository;

use App\Entity\Parking;
use Doctrine\ORM\EntityRepository;

class ParkingRepository extends EntityRepository
{
    public function showPark(Parking $parking): array
    {
        $qb = $this->createQueryBuilder('p');

        $qb = $qb->select('p')
            ->innerJoin('p.disponibility', 'd')
            ->where($qb->expr()->eq('d.id', ':price'));

        return $qb->setParameter(':price', $parking->getId())
            ->getQuery()
            ->getResult();
    }


}