<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Entity\Location;
use App\Form\LocationType;
use App\Repository\VehiculeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GarageController extends AbstractController
{
    /**
     * @Route("/garage", name="garage", methods={"GET", "POST"})
     */
    public function index(VehiculeRepository $vehiculeRepository, Request $request): Response
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

        $location = new Location();
        
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $location->setVehicule($vehicules_dispo[0]);

            // REMOVE DE FORM_IS_VALID CAR PASSAIT PAS
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($location);
            $entityManager->flush();

            return $this->redirectToRoute('location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('garage/index.html.twig', [
            'vehicules' => $vehicules_dispo,
            'controller_name' => 'GarageController',
            'form' => $form->createView(),
        ]);
    }
}
