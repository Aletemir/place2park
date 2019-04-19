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
     * @Route("/new_disponibility", name="new_dispo")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new_disponibility(Request $request)
    {
        $parkDispo = new Disponibility();
        $this->getDoctrine()->getRepository(Disponibility::class)->findBy(["parkingId"]);
        $form = $this->createForm(DisponibilityType::class, $parkDispo);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parkDispo);
            $em->flush();

        dump($parkDispo); die();

            return $this->redirectToRoute('user_index');
        }
        return $this->render('disponibility/_new_disponibility.html.twig', [
            'form' => $form->createView()
        ]
        );
    }
}
