<?php

namespace App\DataFixtures;

use App\Entity\Prix;
use App\Entity\Depart;
use App\Entity\Categorie;
use App\Entity\Destination;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TypeFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $cat1 = new Categorie();
        $cat1->setCategorie("PREMIUM");
        $manager->persist($cat1);

        $cat2 = new Categorie();
        $cat2->setCategorie("VIP");
        $manager->persist($cat2);

        $cat3 = new Categorie();
        $cat3->setCategorie("CLASSIC");
        $manager->persist($cat3);

        $depart1 = new Depart();
        $depart1->setVille("Antananarivo");
        $manager->persist($depart1);

        $destination1 = new Destination();
        $destination1->setVille("Toamasina");
        $manager->persist($destination1);
        
        $prix1 = new Prix();
        $prix1->setPrix(40000)
             ->setCategorie($cat1)
             ->setDepart($depart1)
             ->setDestination($destination1);
        $manager->persist($prix1);

        $prix2 = new Prix();
        $prix2->setPrix(40000)
             ->setCategorie($cat2)
             ->setDepart($depart1)
             ->setDestination($destination1);
        $manager->persist($prix2);

        $prix3 = new Prix();
        $prix3->setPrix(40000)
             ->setCategorie($cat3)
             ->setDepart($depart1)
             ->setDestination($destination1);
        $manager->persist($prix3);

        
        $destination2 = new Destination();
        $destination2->setVille("Mahajanga");
        $manager->persist($destination2);
        
        $prix4 = new Prix();
        $prix4->setPrix(40000)
             ->setCategorie($cat1)
             ->setDepart($depart1)
             ->setDestination($destination2);
        $manager->persist($prix4);

        $prix5 = new Prix();
        $prix5->setPrix(40000)
             ->setCategorie($cat2)
             ->setDepart($depart1)
             ->setDestination($destination2);
        $manager->persist($prix5);

        $prix6 = new Prix();
        $prix6->setPrix(40000)
             ->setCategorie($cat3)
             ->setDepart($depart1)
             ->setDestination($destination2);
        $manager->persist($prix6);

        $manager->flush();
    }
}
