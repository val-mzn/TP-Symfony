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
        return $this->render('garage/index.html.twig', [
            'vehicules' => $vehiculeRepository->findAll(),
            'controller_name' => 'GarageController',
        ]);
    }
}
