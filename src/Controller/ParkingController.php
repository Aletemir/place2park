<?php

namespace App\Controller;

use App\Entity\Disponibility;
use App\Entity\Parking;
use App\Entity\User;
use App\Form\ParkingType;
use Curl\Curl;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 */
class ParkingController extends BaseController
{
    /**
     * @Route("/show/{id}", name="show_park", methods="GET")
     */
    public function show(Parking $parking)
    {
//    $park = $this->getDoctrine()->getRepository(Parking::class)->findOneParkById($parking->getId());
    dump($parking);
    return $this->render('parking/show.html.twig', [
        'parking' => $parking,
        ]);
    }

    /**
     * @Route("/parks" , name="show_parks_by_price")
     */
    public function showParksByPrice()
    {
        $parkings = $this->getDoctrine()->getRepository(Parking::class)->findAllWithPrice();
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(['id'=> $this->getUser()]);
        dump($parkings);
        return $this->render('parking/index.html.twig', [
            'parkings' => $parkings,
            'users'=> $users,
        ]);
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
            return $this->redirectToRoute('new_dispo', [ "id" => $parking->getId() ]);
        }
    return $this->render('parking/_new_parking.html.twig', ['form'=>$form->createView()]);
    }
}
