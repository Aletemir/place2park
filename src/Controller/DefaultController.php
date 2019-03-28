<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage(): Response
    {
        return $this->render('default/homepage.html.twig');
    }


    


}
