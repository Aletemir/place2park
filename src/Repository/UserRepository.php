<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findParkingFromUserReservation(): array
    {
        $qb = $this->createQueryBuilder('user');

        $qb = $qb ->select('user', 'reservations', 'disponibility', 'parking')
            ->innerJoin('user.reservations', 'reservations')
            ->innerJoin('reservations.disponibilities', 'disponibility')
            ->innerJoin('disponibility.parking', 'parking')
            ->where($qb->expr()->eq('user.id', 'reservations.user'))
            ->andWhere($qb->expr()->eq('reservations.id', 'disponibility.reservation'))
            ->andwhere($qb->expr()->eq('parking.id', 'disponibility.parking'))
            ->groupBy('reservations.dateStart');


        return $qb->getQuery()->getResult();
    }

}
