<?php


namespace App\DataFixtures;

use App\Entity\Type;
use App\Entity\Parking;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class ParkingFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $park1 = new Parking();
        $park1->setTitle('Petit Parking');
        $park1->setPicture('park-1');
        $park1->setDescription('Ça sounds good, tu vois au passage qu\'il n\'y a rien de concret car là, j\'ai un chien en ce moment à côté de moi et je le caresse, et c\'est une sensation réelle qui se produit si on veut ! Et là, vraiment, j\'essaie de tout coeur de donner la plus belle réponse de la terre !');
        $park1->setCity('Rennes');
        $park1->setDistrict('Le maille');
        $park1->setStreet('15 rue de la mortadelle');
        $park1->setType($this->getReference('type-cour'));
        $park1->setUser($this->getReference('user-1'));
        $park1->setLatitude(48.1119800);
        $park1->setLongitude(-1.6742900);
        $manager->persist($park1);

        $park2 = new Parking();
        $park2->setTitle('Garage à disposition');
        $park2->setPicture('park-2');
        $park2->setDescription('Tu comprends, tu vois au passage qu\'il n\'y a rien de concret car on vit dans une réalité qu\'on a créée et que j\'appelle illusion puisque the final conclusion of the spirit is perfection C\'est cette année que j\'ai eu la révélation !');
        $park2->setCity('Rennes');
        $park2->setDistrict('Villejean');
        $park2->setStreet('122 boulevard des airs');
        $park2->setType($this->getReference('type-garage'));
        $park2->setUser($this->getReference('user-2'));
        $park2->setLatitude(48.117915);
        $park2->setLongitude(-1.702866);
        $manager->persist($park2);

        $manager->flush();
    }
}