<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Repository\VehiculeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GarageController extends AbstractController
{
    /**
     * @Route("/garage", name="garage")
     */
    public function index(VehiculeRepository $vehiculeRepository): Response
    {
        date_default_timezone_set('Europe/Paris');

        $vehicules = $vehiculeRepository->findAll();
        $vehicules_dispo = [];

        foreach($vehicules as $v)
        {
            $locations = $v->getLocations();
            $dispo = true;

            foreach($locations as $l)
            {
                $start = $l->getDebut()->getTimestamp();
                $end = $l->getFin()->getTimestamp();

                if(time() > $start && time() < $end)
                {
                    $dispo = false;
                    break;
                }
            }

            if($dispo)
            {
                array_push($vehicules_dispo, $v);
            }
        }

        return $this->render('garage/index.html.twig', [
            'vehicules' => $vehicules_dispo,
            'controller_name' => 'GarageController',
        ]);
    }
}
