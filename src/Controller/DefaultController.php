<?php

namespace App\Controller;

use App\Entity\Parking;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App/Controller
 */

class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        return $this->render('default/homepage.html.twig');
    }




}
