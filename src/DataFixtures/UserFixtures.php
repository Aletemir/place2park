<?php


namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setFirstname('Doe');
        $user1->setLastname('Djohn');
        $user1->setBirthdate(new \DateTime('12-10-1992'));
        $user1->setAdress('15 rue de la mortadelle');
        $user1->setEmail('ddjhn@lolo.fr');
        $user1->setPassword('lolilol');
        $user1->setPicture('user-1.png');
        $user1->setRib('12345123451234567891A12');
        $manager->persist($user1);
        $this->addReference('user-1', $user1);

        $user2 = new User();
        $user2->setFirstname('Broxon');
        $user2->setLastname('Conrad');
        $user2->setBirthdate(new \DateTime('22/03/2001'));
        $user2->setAdress('122 boulevard des airs');
        $user2->setEmail('jojo@bernard.net');
        $user2->setPassword('Ricky');
        $user2->setPicture('user-2');
        $user2->setIban('FR143000101010000Z670647462');
        $manager->persist($user2);
        $this->addReference('user-2', $user2);
        $user3 = new User();
        $user3->setFirstname('Troump');
        $user3->setLastname('Danold');
        $user3->setBirthdate(new \DateTime('12/05/1902'));
        $user3->setAdress('23 avenue des rigadons');
        $user3->setEmail('troump.d@lmb.us');
        $user3->setPassword('AmagodOeRt');
        $user3->setPicture('user-3');
        $user3->setIban('US115632515455625A254456841');
        $manager->persist($user3);
        $this->addReference('user-3', $user3);

        $user4 = new User();
        $user4->setFirstname('Lirou');
        $user4->setLastname('Claude');
        $user4->setBirthdate(new \DateTime('13/01/1983'));
        $user4->setAdress('13 rue des grogs');
        $user4->setEmail('lircla@lbdr.com');
        $user4->setPassword('mamamanlaplubell');
        $user4->setPicture('user-4');
        $user4->setIban('FR154265555447856V558569856');
        $manager->persist($user4);
        $this->addReference('user-4', $user4);

        $manager->flush();
    }

}