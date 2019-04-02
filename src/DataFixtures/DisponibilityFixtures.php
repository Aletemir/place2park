<?php

namespace App\DataFixtures;

use App\Entity\Disponibility;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DisponibilityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $parkDispo1 = new Disponibility();
        $parkDispo1->setDateStart((new \DateTime('now'))->add(new \DateInterval('P10D')));
        $parkDispo1->setDateEnd((new \DateTime('now'))->add(new \DateInterval('P30D')));
        $parkDispo1->setParking($this->getReference('park-1'));
        $parkDispo1->setReservation($this->getReference('resa-1'));
        $parkDispo1->setPrice(12);
        $manager->persist($parkDispo1);
        $this->setReference('dispo-1', $parkDispo1);

        $parkDispo2 = new Disponibility();
        $parkDispo2->setDateStart(new \DateTime('20-02-2019'));
        $parkDispo2->setDateEnd(new \DateTime('05-05-2019'));
        $parkDispo2->setParking($this->getReference('park-2'));
        $parkDispo2->setReservation($this->getReference('resa-2'));
        $parkDispo2->setPrice(9);
        $manager->persist($parkDispo2);
        $this->setReference('dispo-2', $parkDispo2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ParkingFixtures::class, ReservationFixtures::class];
    }
}
