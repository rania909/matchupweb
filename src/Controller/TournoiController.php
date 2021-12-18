<?php

namespace App\Controller;

use App\Entity\Tournoi;
use App\Form\TournoiType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tournoi")
 */
class TournoiController extends AbstractController
{
    /**
     * @Route("/", name="tournoi_index", methods={"GET"})
     */
    public function index(): Response
    {
        $tournois = $this->getDoctrine()
            ->getRepository(Tournoi::class)
            ->findAll();

        return $this->render('tournoi/index.html.twig', [
            'tournois' => $tournois,
        ]);
    }

    /**
     * @Route("/new", name="tournoi_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tournoi = new Tournoi();
        $form = $this->createForm(TournoiType::class, $tournoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tournoi);
            $entityManager->flush();

            return $this->redirectToRoute('tournoi_index');
        }

        return $this->render('tournoi/new.html.twig', [
            'tournoi' => $tournoi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idTournoi}", name="tournoi_show", methods={"GET"})
     */
    public function show(Tournoi $tournoi): Response
    {
        return $this->render('tournoi/show.html.twig', [
            'tournoi' => $tournoi,
        ]);
    }

    /**
     * @Route("/{idTournoi}/edit", name="tournoi_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tournoi $tournoi): Response
    {
        $form = $this->createForm(TournoiType::class, $tournoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tournoi_index');
        }

        return $this->render('tournoi/edit.html.twig', [
            'tournoi' => $tournoi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idTournoi}", name="tournoi_delete", methods={"POST"})
     */
    public function delete(Request $request, Tournoi $tournoi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tournoi->getIdTournoi(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tournoi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tournoi_index');
    }
}
