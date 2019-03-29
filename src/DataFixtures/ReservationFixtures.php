<?php

namespace App\DataFixtures;

use App\Entity\Reservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ReservationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $resa1 = new Reservation();
        $resa1->setDateStart(new \DateTime('13-05-2018'));
        $resa1->setDateEnd(new \DateTime('15-06-2018'));
        $resa1->setUser($this->getReference('user-3'));
        $resa1->setPaid(true);
        $manager->persist($resa1);
        $this->setReference('resa-1', $resa1);


        $resa2 = new Reservation();
        $resa2->setDateStart(new \DateTime('21-02-2019'));
        $resa2->setDateEnd(new \DateTime('05-05-2019'));
        $resa2->setUser($this->getReference('user-4'));
        $resa2->setPaid(false);
        $manager->persist($resa2);
        $this->setReference('resa-2', $resa2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
