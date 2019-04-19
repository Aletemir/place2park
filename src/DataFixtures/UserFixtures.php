<?php


namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class UserFixtures extends Fixture
{
    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setFirstname('Doe');
        $user1->setLastname('Djohn');
        $user1->setAdress('15 rue de la mortadelle');
        $user1->setEmail('ddjhn@lolo.fr');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'lolilol'));
        $user1->setCreatedAt(new \DateTime('15-04-2018'));
        $user1->setPicture('user-1.png');
        $user1->setRoles(['ROLE_USER']);

        $manager->persist($user1);
        $this->addReference('user-1', $user1);

        $user2 = new User();
        $user2->setFirstname('Broxon');
        $user2->setLastname('Conrad');
        $user2->setAdress('122 boulevard des airs');
        $user2->setEmail('jojo@bernard.net');
        $user2->setPassword($this->passwordEncoder->encodePassword($user2, 'Ricky'));
        $user2->setCreatedAt(new \DateTime('15-04-2019'));
        $user2->setPicture('user-2.jpg');
        $user2->setRoles(['ROLE_USER']);

        $manager->persist($user2);
        $this->addReference('user-2', $user2);

        $user3 = new User();
        $user3->setFirstname('Troump');
        $user3->setLastname('Danold');
        $user3->setAdress('23 avenue des rigadons');
        $user3->setEmail('troump.d@lmb.us');
        $user3->setPassword($this->passwordEncoder->encodePassword($user3,'AmagodOeRt'));
        $user3->setCreatedAt(new \DateTime('15-04-2019'));
        $user3->setPicture('user-3.jpg');
        $user3->setRoles(['ROLE_USER']);
        $manager->persist($user3);
        $this->addReference('user-3', $user3);

        $user4 = new User();
        $user4->setFirstname('Lirou');
        $user4->setLastname('Claude');
        $user4->setAdress('13 rue des grogs');
        $user4->setEmail('lircla@lbdr.com');
        $user4->setPassword($this->passwordEncoder->encodePassword($user4, 'mamamanlaplubell'));
        $user4->setCreatedAt(new \DateTime('15-04-2019'));
        $user4->setPicture('user-4.jpg');
        $user4->setRoles(['ROLE_USER']);

        $manager->persist($user4);
        $this->addReference('user-4', $user4);

        $user5 = new User();
        $user5->setFirstname('MJ');
        $user5->setLastname('Misty');
        $user5->setAdress('13 avenue des Vent glacials');
        $user5->setEmail('a.barrier92@gmail.com');
        $user5->setPassword($this->passwordEncoder->encodePassword($user5, "1234"));
        $user5->setCreatedAt(new \DateTime('15-04-2019'));
        $user5->setPicture('photoMistyMJ.jpg');
        $user5->setRoles(['ROLE_ADMIN']);

        $manager->persist($user5);
        $this->addReference('user-5', $user5);

        $manager->flush();
    }

}