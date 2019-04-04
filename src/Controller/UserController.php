<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use function MongoDB\BSON\toJSON;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods="GET")
     */
    public function index(): Response
    {

        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('user/index.html.twig', ['users' => $users]);
    }

    /**
     * @Route("/user", name="user_show")
     */
    public function showuser()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(["id"=> $this->getUser()]);
        dump($users);
        return $this->render('user/show.html.twig', ['users' => $users]);

    }
}
