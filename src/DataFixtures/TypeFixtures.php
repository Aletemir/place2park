<?php


namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $garage = new Type();
        $garage->setLabel('Garage');
        $manager->persist($garage);
        $this->setReference('type-garage', $garage);

        $cour = new Type();
        $cour->setLabel('Cour');
        $manager->persist($cour);
        $this->setReference('type-cour', $cour);

        $parkSout = new Type();
        $parkSout->setLabel('Parking souterrain');
        $manager->persist($parkSout);
        $this->setReference('type-parkSout', $parkSout);

        $manager->flush();
    }
}