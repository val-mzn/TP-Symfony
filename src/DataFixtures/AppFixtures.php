<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Vehicule;
use App\Entity\Client;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $renault = new Marque();
        $renault->setNom('Renault');
        $manager->persist($renault);

        $twingo = new Modele();
        $twingo->setNom("Twingo");
        $twingo->setTarif(25);
        $twingo->setMarque($renault);
        $manager->persist($twingo);

        $clio = new Modele();
        $clio->setNom('Clio');
        $clio->setTarif(35);
        $clio->setMarque($renault);
        $manager->persist($clio);

        $megane = new Modele();
        $megane->setNom('Megane');
        $megane->setTarif(45);
        $megane->setMarque($renault);
        $manager->persist($megane);


        $peugeot = new Marque();
        $peugeot->setNom('Peugeot');
        $manager->persist($peugeot);

        $_208 = new Modele();
        $_208->setNom("208");
        $_208->setTarif(30);
        $_208->setMarque($peugeot);
        $manager->persist($_208);

        $_508 = new Modele();
        $_508->setNom('508');
        $_508->setTarif(40);
        $_508->setMarque($peugeot);
        $manager->persist($_508);

        $_3008 = new Modele();
        $_3008->setNom('3008');
        $_3008->setTarif(50);
        $_3008->setMarque($peugeot);
        $manager->persist($_3008);


        $citroen = new Marque();
        $citroen->setNom('Citroën');
        $manager->persist($citroen);

        $c1 = new Modele();
        $c1->setNom("C1");
        $c1->setTarif(30);
        $c1->setMarque($citroen);
        $manager->persist($c1);

        $c3 = new Modele();
        $c3->setNom('C3');
        $c3->setTarif(40);
        $c3->setMarque($citroen);
        $manager->persist($c3);

        $ds4 = new Modele();
        $ds4->setNom('DS4');
        $ds4->setTarif(50);
        $ds4->setMarque($citroen);
        $manager->persist($ds4);

        $vehicule0 = new Vehicule();
        $vehicule0->setModele($c1);
        $vehicule0->setPlaque("WD742FG");
        $vehicule0->setKilometrage(120000);
        $vehicule0->setEtat("marquée parchoc avant et arrière");
        $manager->persist($vehicule0);
        
        $vehicule1 = new Vehicule();
        $vehicule1->setModele($ds4);
        $vehicule1->setPlaque("TB230NM");
        $vehicule1->setKilometrage(50000);
        $vehicule1->setEtat("quasi neuve");
        $manager->persist($vehicule1);

        $vehicule2 = new Vehicule();
        $vehicule2->setModele($twingo);
        $vehicule2->setPlaque("EE666RR");
        $vehicule2->setKilometrage(50000);
        $vehicule2->setEtat("ammochée");
        $manager->persist($vehicule2);
        
        $client0 = new Client();
        $client0->setNom("Manzon");
        $client0->setPrenom("Valentino");
        $client0->setTelephone("0783001122");
        $client0->setAdresse("LA SUISSE");
        $client0->setVille("GENF");
        $client0->setCp(1200);
        $manager->persist($client0);

        $manager->flush();
    }
}
