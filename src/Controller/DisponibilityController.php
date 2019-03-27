<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DisponibilityController extends AbstractController
{
    /**
     * @Route("/disponibility", name="disponibility")
     */
    public function index()
    {
        return $this->render('disponibility/index.html.twig', [
            'controller_name' => 'DisponibilityController',
        ]);
    }
}
