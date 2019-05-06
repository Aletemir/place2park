<?php

namespace App\Controller;

use App\Entity\Parking;
use App\Entity\User;
use App\Form\UserType;
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
    public function showUser()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(["id"=> $this->getUser()]);
        dump($users);
        return $this->render('user/index.html.twig', ['users' => $users]);
    }

    public function edit(Request $request, User $user)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index', ['id' => $user->getId()]);
        }
        return $this->render('user/edit.html.twig', ['user' => $user, 'form' => $form->createView(),]);
    }

    /**
     * @Route("/{id}/parks", name="user_parks_list")
     */
    public function showAllParkPossessed(User $user)
    {
        dump($user);
//        $users = $this->getDoctrine()->getRepository(User::class)->findBy(["id" => $this->getUser()]);
        return $this->render('user/show_user_parking_possessed.html.twig', [
            'user' => $user
        ]);
    }



}
