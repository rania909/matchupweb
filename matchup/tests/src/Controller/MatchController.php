<?php

namespace App\Controller;

use App\Entity\Match;
use App\Form\MatchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/match")
 */
class MatchController extends AbstractController
{
    /**
     * @Route("/", name="match_index", methods={"GET"})
     */
    public function index(): Response
    {
        $matches = $this->getDoctrine()
            ->getRepository(Match::class)
            ->findAll();

        return $this->render('match/index.html.twig', [
            'matches' => $matches,
        ]);
    }

    /**
     * @Route("/new", name="match_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $match = new Match();
        $form = $this->createForm(MatchType::class, $match);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($match);
            $entityManager->flush();

            return $this->redirectToRoute('match_index');
        }

        return $this->render('match/new.html.twig', [
            'match' => $match,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idMatch}", name="match_show", methods={"GET"})
     */
    public function show(Match $match): Response
    {
        return $this->render('match/show.html.twig', [
            'match' => $match,
        ]);
    }

    /**
     * @Route("/{idMatch}/edit", name="match_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Match $match): Response
    {
        $form = $this->createForm(MatchType::class, $match);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('match_index');
        }

        return $this->render('match/edit.html.twig', [
            'match' => $match,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idMatch}", name="match_delete", methods={"POST"})
     */
    public function delete(Request $request, Match $match): Response
    {
        if ($this->isCsrfTokenValid('delete'.$match->getIdMatch(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($match);
            $entityManager->flush();
        }

        return $this->redirectToRoute('match_index');
    }
}
