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

    public function findAllParksByUser(User $user): array
    {
        $qb = $this->createQueryBuilder('u');

        $qb = $qb->select('u')
            ->innerJoin('u.parking', 'p')
            ->where($qb->expr()->eq('p.id',':parking'))
            ->orderBy('p.created_at', 'DESC');


        return $qb->setParameter(':user', $user->getId())
            ->getQuery()
            ->getResult();

    }
}
