<?php

namespace App\Controller;

use App\Entity\Disponibility;
use App\Entity\Parking;
use App\Form\DisponibilityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DisponibilityController extends AbstractController
{
    //form for set disponibility of new parking created
    /**
     * @Route("/{id}/new_disponibility", name="new_dispo")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new_disponibility(Request $request, Parking $parking)
    {
        $parkDispo = new Disponibility();
        $parkDispo->setParking($parking);

        $form = $this->createForm(DisponibilityType::class, $parkDispo);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $parkDispo = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($parkDispo);
            $em->flush();
//            TODO this route have to redirect to user list of park
            return $this->redirectToRoute('show_park');
        }
        return $this->render('disponibility/_new_disponibility.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/disponibility/{parking}", name="show_dispo_by_park"))
     * @return Response
     */
    public function show(Disponibility $disponibility)
    {
        $park = $this->getDoctrine()->getRepository(Disponibility::class)->findBy(['id'=> $disponibility->getId()]);
        dump($park);
        return $this->render('disponibility/index.html.twig', [
            'disponibility'=>$disponibility,
        ]);
    }
}
