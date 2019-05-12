<?php

namespace App\Controller;

use App\Entity\Disponibility;
use App\Entity\Parking;
use App\Entity\Reservation;
use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("parking/{id}/reservation", name="reservation")
     */
    public function index()
    {
        $resa = $this->getDoctrine()->getRepository()->findAll();

        return $this->render('reservation/index.html.twig', ['resas' => $resa]);
    }

    /**
     * @Route("/reservation/{parkingName}", name="add_new_reservation")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(Request $request)
    {
        $reservation = new Reservation();
        $disponibility =  $reservation->getDisponibilities();
        $reservation->setUser($this->getUser());


        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            // TODO think where this route redirect, for test this route redirect to the homepage
            return $this->redirectToRoute('homepage');
        }
        return $this->render('reservation/new_reservation.html.twig', [
            'resa' => $reservation,
            'form'=>$form->createView(),
            'dispo' => $disponibility,
        ]);
    }
}
