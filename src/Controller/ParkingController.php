<?php

namespace App\Controller;

use App\Entity\Disponibility;
use App\Entity\Parking;
use App\Entity\User;
use App\Entity\ViewsPark;
use App\Form\DisponibilityType;
use App\Form\ParkingType;
use Curl\Curl;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 */
class   ParkingController extends BaseController
{

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
//         TODO IMPORTANT have to get the adress with longitude and latitude /!\
        $curl->setOpt(CURLOPT_RETURNTRANSFER, TRUE);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, FALSE);
        // TODO find how to set the adress on parameter
        $curl->get("https://api-adresse.data.gouv.fr/search/q" . $this->getUser()->getAdress() . "&autocomplete=1");
//        dump(json_decode($curl->response));die

        $form = $this->createForm(ParkingType::class, $parking);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parking);
            $entityManager->flush();
            // redirect user to the disponibilties page
            return $this->redirectToRoute('new_dispo', ["id" => $parking->getId()]);
        }
        return $this->render('parking/_new_parking.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("/show/{id}", name="show_park", methods="GET")
     */
    public function show(Parking $parking)
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(['id' => $this->getUser()]);
        $allRate = $this->getDoctrine()->getRepository(ViewsPark::class)->findBy(['parking' => $parking->getId()]);
        $rateByUser = $this->getDoctrine()->getRepository(ViewsPark::class)->findOneBy(['user' => $this->getUser()]);
//        dump($users); die();
        dump($allRate);

        dump($rateByUser);
        return $this->render('parking/show.html.twig', [
            'parking' => $parking,
            'ratings' => $allRate,
            'userRate' => $rateByUser,
            'users' => $users
        ]);
    }

    /**
     * @Route("/parks" , name="show_parks")
     */
    public function showParksByPrice()
    {
        $parkings = $this->getDoctrine()->getRepository(Parking::class)->findAllWithPrice();
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(['id' => $this->getUser()]);
        dump($parkings);
        return $this->render('parking/index.html.twig', ['parkings' => $parkings, 'users' => $users,]);
    }


    /**
     * @Route("/{id}/parks", name="user_parks_list")
     */
    public function showAllParkPossessed(User $user)
    {
        dump($user);
        $parking = $this->getDoctrine()->getRepository(Parking::class)
            ->findBy(
            ['user' => $this->getUser()],
            ['id' => 'DESC']);
        dump($parking);
//        $users = $this->getDoctrine()->getRepository(User::class)->findBy(["id" => $this->getUser()]);
        return $this->render('user/show_user_parking_possessed.html.twig', [
            'user' => $user,
            'parkings' => $parking,
        ]);
    }

    /**
     * @Route("/{id}/rentedParks/", name="user_parks_rented")
     */
    public function showAllRentedPark(User $user)
    {
//        dump($user);
        $userRentedParks = $this->getDoctrine()->getRepository(Parking::class)->findParkingFromUserReservation();
        dump($userRentedParks);

        return $this->render('user/show_user_parking_rented.html.twig', [
            'user' => $user,
            'userRentedPark' => $userRentedParks,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="parking_edit", methods="GET|POST")
     */
    public function edit(Request $request,Parking $parking): Response
    {
        $formParking = $this->createForm(ParkingType::class, $parking);

        $formParking->handleRequest($request);

        if ( $formParking->isSubmitted() && $formParking->isValid() ){
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('show_park', ['id' => $parking->getId()]);
        }
        return $this->render('parking/edit.html.twig', [
            'parking' => $parking,
            'formParking'=> $formParking->createView(),
        ]);
    }

    /**
     * @Route("/{parkName}/delete", name="parking_delete", methods="DELETE")
     */
    public function delete(Request $request, Parking $parking): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parking->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($parking);
            $em->flush();
        }
        return $this->redirectToRoute('user_index');
    }


}
