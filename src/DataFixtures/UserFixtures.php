<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tabUsers = [
            0 => ['Gaëtan', new DateTime('1987-04-14'),'Lyon' ],
            1 => ['Maud', new DateTime('1993-06-25'),'Lyon'],
            2 => ['Clara', new DateTime('2003-02-14'),'Villeurbanne' ],
            3 => ['Yannis', new DateTime('2010-09-30'), 'Vienne' ],
        ];
        for ($i = 0; $i < count($tabUsers); $i++) {
            $user = new User;
            $user->setName($tabUsers[$i][0]);
            $user->setBirthDate($tabUsers[$i][1]);
            $user->setCity($tabUsers[$i][2]);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
