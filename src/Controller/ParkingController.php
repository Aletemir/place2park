<?php

namespace App\Controller;

use App\Entity\Parking;
use App\Form\ParkingType;
use Curl\Curl;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 */
class ParkingController extends BaseController
{
//    /**
//     * @Route("/parks", name="show_parks")
//     */
//    public function showAllParks()
//    {
//        $parks = $this->getDoctrine()->getRepository(Parking::class)->findAll()
//        return
//    }

    /**
     * @Route("/park/show", name="show_park")
     */
    public function showOnePark(Parking $parking)
    {
        $park = $this->getDoctrine()->getRepository(Parking::class)->findOneBy(['id' => $parking->getId()]);
        dump($park);
        return $this->render('parking/parking_show.html.twig', ['parking' => $park]);
    }

    /**
     * @Route("/park" , name="show_parks_by_price")
     */
    public function showParksByPrice()
    {
        $parkings = $this->getDoctrine()->getRepository(Parking::class)->findAllWithPrice();
        dump($parkings);
        return $this->render('parking/index.html.twig', ['parkings' => $parkings]);
    }

    /**
     * @Route("/add-parking", name="new_parking")
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws \ErrorException
     */
    public function new_parking(Request $request)
    {

        $parking = new Parking();
        $parking->setUser($this->getUser());
        $curl = new Curl();
        $curl->setOpt(CURLOPT_RETURNTRANSFER, TRUE);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, FALSE);
        $curl->get("https://api-adresse.data.gouv.fr/search", ["q" => $this->getUser()->getAdress()]);
//        dump(json_decode($curl->response));die

        $form = $this->createForm(ParkingType::class, $parking);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parking);
            $entityManager->flush();
            // redirect user to the disponibilties page
            return $this->redirectToRoute('new_dispo');
        }
    return $this->render('parking/_new_parking.html.twig', ['form'=>$form->createView()]);
    }
}
