<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Vehicule;

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

        $vehicule = new Vehicule();
        $vehicule->setModele($c1);
        $vehicule->setPlaque("WD742FG");
        $vehicule->setKilometrage(120000);
        $vehicule->setEtat("marquée parchoc avant et arrière");
        $manager->persist($vehicule);
        
        $vehicule = new Vehicule();
        $vehicule->setModele($ds4);
        $vehicule->setPlaque("TB230NM");
        $vehicule->setKilometrage(50000);
        $vehicule->setEtat("quasi neuve");
        $manager->persist($vehicule);
    
        $manager->flush();
    }
}
