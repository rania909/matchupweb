<?php

namespace App\Controller;

use App\Entity\Resterrain;
use App\Form\ResterrainType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/resterrain")
 */
class ResterrainController extends AbstractController
{
    /**
     * @Route("/", name="resterrain_index", methods={"GET"})
     */
    public function index(): Response
    {
        $resterrains = $this->getDoctrine()
            ->getRepository(Resterrain::class)
            ->findAll();

        return $this->render('resterrain/index.html.twig', [
            'resterrains' => $resterrains,
        ]);
    }

    /**
     * @Route("/new", name="resterrain_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $resterrain = new Resterrain();
        $form = $this->createForm(ResterrainType::class, $resterrain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($resterrain);
            $entityManager->flush();

            return $this->redirectToRoute('resterrain_index');
        }

        return $this->render('resterrain/new.html.twig', [
            'resterrain' => $resterrain,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idRester}", name="resterrain_show", methods={"GET"})
     */
    public function show(Resterrain $resterrain): Response
    {
        return $this->render('resterrain/show.html.twig', [
            'resterrain' => $resterrain,
        ]);
    }

    /**
     * @Route("/{idRester}/edit", name="resterrain_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Resterrain $resterrain): Response
    {
        $form = $this->createForm(ResterrainType::class, $resterrain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('resterrain_index');
        }

        return $this->render('resterrain/edit.html.twig', [
            'resterrain' => $resterrain,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idRester}", name="resterrain_delete", methods={"POST"})
     */
    public function delete(Request $request, Resterrain $resterrain): Response
    {
        if ($this->isCsrfTokenValid('delete'.$resterrain->getIdRester(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($resterrain);
            $entityManager->flush();
        }

        return $this->redirectToRoute('resterrain_index');
    }
}
