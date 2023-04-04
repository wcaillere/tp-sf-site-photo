<?php

namespace App\DataFixtures;

use App\Factory\PhotoFactory;
use App\Factory\PhotographFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        PhotographFactory::createMany(6);

        PhotoFactory::createMany(25);
    }
}
