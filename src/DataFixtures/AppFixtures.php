<?php

namespace App\DataFixtures;

use App\Entity\Location;
use App\Entity\Venue;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->createVenues($manager);

        $manager->flush();
    }

    private function createVenues(ObjectManager $manager): void
    {
        $manager->persist((new Venue())
            ->setName('Westside Soccer Arena')
            ->setLocation(
                (new Location())
                    ->setStreet('Bahnhofstraße 1D')
                    ->setZipCode('1140')
                    ->setCity('Vienna')
                    ->setCountry('AT')
                    ->setPlaceId('abc')
            ));

        $manager->persist((new Venue())
            ->setName('Allianz-Stadion')
            ->setLocation(
                (new Location())
                    ->setStreet('Gerhard-Hanappi-Platz 1')
                    ->setZipCode('1140')
                    ->setCity('Vienna')
                    ->setCountry('AT')
                    ->setPlaceId('def')
            ));

        $manager->persist((new Venue())
            ->setName('ASV13')
            ->setLocation(
                (new Location())
                    ->setStreet('Linienamtsgasse 7')
                    ->setZipCode('1130')
                    ->setCity('Vienna')
                    ->setCountry('AT')
                    ->setPlaceId('ghi')
            ));
    }
}
