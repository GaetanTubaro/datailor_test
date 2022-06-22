<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;
use App\Entity\VoucherCode;
use DateInterval;

class VoucherCodeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $voucher1 = new VoucherCode;
        $voucher1->setName('VIVELESVACANCES')
            ->setStartingDate(new DateTime('2022-05-06'))
            ->setEndingDate(new DateTime('2022-07-03'));
        $manager->persist($voucher1);

        $voucher2 = new VoucherCode;
        $voucher2->setName('ETUDIANT23')
            ->setBirthLimit(new DateInterval('P23Y'))
            ->setStartingDate(new DateTime('2022-09-03'))
            ->setEndingDate(new DateTime('2022-01-12'));
        $manager->persist($voucher2);

        $voucher3 = new VoucherCode;
        $voucher3->setName('ONLYVIENNE')
            ->setStartingDate(new DateTime('2022-05-03'));
        $manager->persist($voucher3);

        $voucher4 = new VoucherCode;
        $voucher4->setName('PROMO34')
            ->setCityLimit('Lyon')
            ->setStartingDate(new DateTime('2022-05-03'));
        $manager->persist($voucher4);

        $manager->flush();
    }
}
