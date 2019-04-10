<?php

namespace App\Controller;

use App\Entity\Disponibility;
use App\Form\DisponibilityType;
use function PHPSTORM_META\elementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DisponibilityController extends AbstractController
{
    //form for set disponibility of new parking created
    /**
     * @Route("/new_disponibility", name="new_dispo")
     * @param Request $request
     */
    public function new_disponibility(Request $request)
    {
        $parkDispo = new Disponibility();

        $form = $this->createForm(DisponibilityType::class, $parkDispo);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($parkDispo);
            $em->flush();
            return $this->redirectToRoute('user_show');
        }
        return $this->render('disponibility/new_disponibility.html.twig', ['form'=>$form->createView()]);
    }

}
