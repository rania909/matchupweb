<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\SignupType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileuserController extends AbstractController
{
    /**
     * @Route("/profileuser", name="profileuser")
     */
    public function index(): Response
    {
        return $this->render('profileuser/index.html.twig', [
            'controller_name' => 'ProfileuserController',
        ]);
    }


}