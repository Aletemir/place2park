<?php

namespace App\Controller;

use App\Entity\Parking;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App/Controller
 */
class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage", methods="GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homepage()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(['id'=> $this->getUser()]);
        dump($users);
        return $this->render('default/homepage.html.twig', ['users' => $users]);
    }
}
