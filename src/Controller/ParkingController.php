<?php

namespace App\Controller;

use App\Entity\Parking;
use App\Form\ParkingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/parking")
 */
class ParkingController extends AbstractController
{
    /**
     * @Route("/", name="parking_index", methods={"GET"})
     */
    public function index(): Response
    {
        $parkings = $this->getDoctrine()
            ->getRepository(Parking::class)
            ->findAll();

        return $this->render('parking/index.html.twig', [
            'parkings' => $parkings,
        ]);
    }

    /**
     * @Route("/new", name="parking_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $parking = new Parking();
        $form = $this->createForm(ParkingType::class, $parking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parking);
            $entityManager->flush();

            return $this->redirectToRoute('parking_index');
        }

        return $this->render('parking/new.html.twig', [
            'parking' => $parking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idParking}", name="parking_show", methods={"GET"})
     */
    public function show(Parking $parking): Response
    {
        return $this->render('parking/show.html.twig', [
            'parking' => $parking,
        ]);
    }

    /**
     * @Route("/{idParking}/edit", name="parking_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Parking $parking): Response
    {
        $form = $this->createForm(ParkingType::class, $parking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parking_index');
        }

        return $this->render('parking/edit.html.twig', [
            'parking' => $parking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idParking}", name="parking_delete", methods={"POST"})
     */
    public function delete(Request $request, Parking $parking): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parking->getIdParking(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($parking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('parking_index');
    }
}
