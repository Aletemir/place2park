<?php

namespace App\Controller;

use App\Entity\Parking;
use http\Env\Response;
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
        $parkings = $this->getDoctrine()->getRepository(Parking::class)->findAll();
        dump($parkings);
        return $this->render('parking/index.html.twig', ['parkings' => $parkings]);
    }

    /**
     * @Route("/park/{id}
     */
    public function showOnePark(Parking $parking)
    {
        $park = $this->getDoctrine()->getRepository(Parking::class)->showPark(['id' => $parking->getId()]);
    }
}
