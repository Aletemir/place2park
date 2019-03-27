<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ParkingController extends AbstractController
{
    /**
     * @Route("/parking", name="parking")
     */
    public function index()
    {
        return $this->render('parking/index.html.twig', [
            'controller_name' => 'ParkingController',
        ]);
    }
}
