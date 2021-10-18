<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\LocationType;
use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/location")
 */
class LocationController extends AbstractController
{
    /**
     * @Route("/", name="location_index", methods={"GET", "POST"})
     */
    public function index(LocationRepository $locationRepository, Request $request): Response
    {
        $location = new Location();
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($location);
            $entityManager->flush();

            return $this->redirectToRoute('location_index', [], Response::HTTP_SEE_OTHER);
        }

        $locations = $locationRepository->findAll();
        $locations_with_price = [];
        foreach($locations as $l){
            $duration = $l->getFin()->getTimestamp() - $l->getDebut()->getTimestamp();
            $l->duree = $duration/60/60/24;
            $l->tarif = $l->getVehicule()->getModele()->getTarif();
            $l->prix = $duration/60/60/24 * $l->getVehicule()->getModele()->getTarif();
            array_push($locations_with_price, $l);
        }

        return $this->render('location/index.html.twig', [
            'locations' => $locations_with_price,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="location_show", methods={"GET"})
     */
    public function show(Location $location): Response
    {

        $duration = $location->getFin()->getTimestamp() - $location->getDebut()->getTimestamp();
        $location->duree = $duration/60/60/24;
        $location->tarif = $location->getVehicule()->getModele()->getTarif();
        $location->prix = $duration/60/60/24 * $location->getVehicule()->getModele()->getTarif();

        return $this->render('location/show.html.twig', [
            'location' => $location,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="location_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Location $location): Response
    {
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location/edit.html.twig', [
            'location' => $location,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="location_delete", methods={"POST"})
     */
    public function delete(Request $request, Location $location): Response
    {
        if ($this->isCsrfTokenValid('delete'.$location->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($location);
            $entityManager->flush();
        }

        return $this->redirectToRoute('location_index', [], Response::HTTP_SEE_OTHER);
    }
}
