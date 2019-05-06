<?php

namespace App\Repository;

use App\Entity\Parking;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Routing\Annotation\Route;

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

    /**
     * @param User $user
     * @return array
     */
    public function findAllParksByUser(): array
    {
        $qb = $this->createQueryBuilder('u');

        $qb = $qb ->select('u')
            ->innerJoin('u.parking' , 'p')
            ->where($qb->expr()->eq('u.id', 'p.user'))
            ->orderBy('p.createdAt', 'DESC');

        return $qb->getQuery()->getResult();

    }


}
