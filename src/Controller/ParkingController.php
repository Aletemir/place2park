<?php

namespace App\Controller;

use App\Entity\Parking;
use App\Form\ParkingType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 */
class ParkingController extends BaseController
{
    /**
     * @Route("/park" , name="show_parks")
     */
    public function showParks()
    {
        $parkings = $this->getDoctrine()->getRepository(Parking::class)->findAllWithPrice();
        dump($parkings);
        return $this->render('parking/index.html.twig', ['parkings' => $parkings]);
    }

    /**
     * @Route("/park/{id}", name="show_park")
     */
    public function showOnePark(Parking $parking)
    {
        $park = $this->getDoctrine()->getRepository(Parking::class)->findOneBy(['id' => $parking->getId()]);
        dump($park);
        return $this->render('parking/parking_show.html.twig', ['parking' => $park]);

    }

    /**
     * @Route("/add-parking", name="new_parking")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function new_parking(Request $request)
    {

        $parking = new Parking();
        $parking->setUser($this->getUser());
// TODO : include gouv api to get latitude and longitude
        $form = $this->createForm(ParkingType::class, $parking);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($parking);
            $entityManager->flush();
            // TODO : redirect user to his parking page
            return $this->redirectToRoute('homepage');
        }

        return $this->render('parking/new_parking.html.twig', ['form' => $form->createView()]);
    }
}
