<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ViewsParkController extends AbstractController
{
    /**
     * @Route("/views/park", name="views_park")
     */
    public function index()
    {
        return $this->render('views_park/index.html.twig', [
            'controller_name' => 'ViewsParkController',
        ]);
    }
}
