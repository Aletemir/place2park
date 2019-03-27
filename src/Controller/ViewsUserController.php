<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ViewsUserController extends AbstractController
{
    /**
     * @Route("/views/user", name="views_user")
     */
    public function index()
    {
        return $this->render('views_user/index.html.twig', [
            'controller_name' => 'ViewsUserController',
        ]);
    }
}
