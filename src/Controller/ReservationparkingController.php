<?php

namespace App\Controller;

use App\Entity\Reservationparking;
use App\Form\ReservationparkingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservationparking")
 */
class ReservationparkingController extends AbstractController
{
    /**
     * @Route("/", name="reservationparking_index", methods={"GET"})
     */
    public function index(): Response
    {
        $reservationparkings = $this->getDoctrine()
            ->getRepository(Reservationparking::class)
            ->findAll();

        return $this->render('reservationparking/index.html.twig', [
            'reservationparkings' => $reservationparkings,
        ]);
    }

    /**
     * @Route("/new", name="reservationparking_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reservationparking = new Reservationparking();
        $form = $this->createForm(ReservationparkingType::class, $reservationparking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservationparking);
            $entityManager->flush();

            return $this->redirectToRoute('reservationparking_index');
        }

        return $this->render('reservationparking/new.html.twig', [
            'reservationparking' => $reservationparking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idrsvparking}", name="reservationparking_show", methods={"GET"})
     */
    public function show(Reservationparking $reservationparking): Response
    {
        return $this->render('reservationparking/show.html.twig', [
            'reservationparking' => $reservationparking,
        ]);
    }

    /**
     * @Route("/{idrsvparking}/edit", name="reservationparking_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reservationparking $reservationparking): Response
    {
        $form = $this->createForm(ReservationparkingType::class, $reservationparking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservationparking_index');
        }

        return $this->render('reservationparking/edit.html.twig', [
            'reservationparking' => $reservationparking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idrsvparking}", name="reservationparking_delete", methods={"POST"})
     */
    public function delete(Request $request, Reservationparking $reservationparking): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationparking->getIdrsvparking(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservationparking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservationparking_index');
    }
}
