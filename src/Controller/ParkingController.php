<?php

namespace App\Controller;

use App\Entity\Parking;
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
}
