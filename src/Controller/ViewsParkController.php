<?php

namespace App\Controller;

use App\Entity\Parking;
use App\Entity\ViewsPark;
use App\Form\ViewsParkType;
use DateTime;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ViewsParkController extends AbstractController
{
//    /**
//     * @Route("", name="views_park")
//     */
//    public function index()
//    {
//        return $this->render('views_park/index.html.twig', ['controller_name' => 'ViewsParkController',]);
//    }

    /**
     * @Route("/rate/park{id}", name="new_rate_park", methods="GET|POST")
     */
    public function new(Request $request, Parking $parking)
    {
        $newRatingPark = new ViewsPark();
        $newRatingPark->setUser($this->getUser());
        $newRatingPark->setParking($parking);

        $form = $this->createForm(ViewsParkType::class, $newRatingPark, [
            'action' => $this->generateUrl('new_rate_park', ['id' => $parking->getId()])
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newRatingPark);
            $em->flush();

            return $this->redirectToRoute('show_park', ['id' => $parking->getId()]);
        }
        return $this->render('viewsPark/new_views_park.html.twig', [
            'newRating' => $newRatingPark,
            'form' => $form->createView()]);
    }


    public function show(ViewsPark $viewsPark){
        return $this->render('parking/show.html.twig', [
           'ratings' => $viewsPark,
        ]);
    }

}
