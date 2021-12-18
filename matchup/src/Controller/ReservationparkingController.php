<?php

namespace App\Controller;

use App\Entity\Reservationparking;
use App\Form\ReservationparkingType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\ReservationparkingRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\JsonResponse;





/**
 * @Route("/reservationparking")
 */
class ReservationparkingController extends AbstractController
{

    /**
     * @Route("/addReservationJSON", name="addreservation")
     */
    public function addReservationJSON( Request $request ,NormalizerInterface $normalizer ){
        $em=$this->getDoctrine()->getManager();
        $reservation=new Reservationparking();
        $reservation->setDateD(new \DateTime($request->get('Dated')));
        $reservation->setDateF(new \DateTime($request->get('Datef')));
       // $reservation->setEmail($request->get('email'));
        $em -> persist($reservation);
        $em->flush();
        $jsonContent=$normalizer->normalize($reservation,'json',['groups'=>'reservationparking']);
        return new Response("Reservation ajoutéé".json_encode($jsonContent));

    }


    /**
     * @Route("/getReservation", name="getReservation")
     */
    public function getReservation()
    {

        $resv=$this->getDoctrine()->getManager()
            ->getRepository(Reservationparking::class)
            ->findAll();

        $data =  array();
        foreach ($resv as $key => $p){

            $data[$key]['idrsvpark']= $p->getIdrsvparking();
            $data[$key]['Dated']= $p->getDateD();
            $data[$key]['Datef']= $p->getDateF();
            $data[$key]['Email']= $p->getEmail();


        }

        return new JsonResponse($data);

    }



    /**
     * @Route("/updatereservationparking/{idrsvparking}", name="updatereservationparking")
     */
    public function ModifierReservation( Request $request ,NormalizerInterface $normalizer , $idrsvparking){
        $em=$this->getDoctrine()->getManager();
        $reservation=$em->getRepository(Reservationparking::class)->find($idrsvparking);


        $reservation->setDateD(new \DateTime($request->get('Dated')));
        $reservation->setDateF(new \DateTime($request->get('Datef')));
        $reservation->setEmail($request->get('email'));

        $em->flush();
        $jsonContent=$normalizer->normalize($reservation,'json',['groups'=>'reservationparking']);
        return new Response("Reservation modifieé  ".json_encode($jsonContent));

    }

    /**
     * @Route("/deletereservationparking/{idrsvparking}", name="deletereservationparking")
     */
    public function SupprimerReservation( Request $request ,NormalizerInterface $normalizer , $idrsvparking){
        $em=$this->getDoctrine()->getManager();
        $reservation=$em->getRepository(Reservationparking::class)->find($idrsvparking);
        $em->remove($reservation);
        $em->flush();
        $jsonContent=$normalizer->normalize($reservation,'json',['groups'=>'reservationparking']);
        return new Response("Reservation supprimée  ".json_encode($jsonContent));

    }
    /**
     * @Route("/listreservationparking", name="listreservationparking")
     */
    public function getreservationparking(reservationparkingRepository $reservationparkingRepository , SerializerInterface $SerializerInterface ){
        $reservationparking=$reservationparkingRepository->findAll();
        $json=$SerializerInterface ->serialize($reservationparking,'json',['groups'=>'reservationparking:read']);
        dump($json);
        die;

    }
    /**
     * @Route("/", name="reservationparking_index", methods={"GET"})
     */
    public function index( Request $request, PaginatorInterface $paginator)
    {
        $donnees = $this->getDoctrine()
            ->getRepository(Reservationparking::class)
            ->findAll();

        $reservationparkings=$paginator->paginate(
            $donnees, //on passe les donnees
            $request->query->getInt('page',1),
            2
        );

        return $this->render('reservationparking/index.html.twig',[
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
     * @Route("/front", name="front_reservation", methods={"GET"})
     */
    public function front(): Response
    {
        $reservationparkings = $this->getDoctrine()
            ->getRepository(Reservationparking::class)
            ->findAll();

        return $this->render('reservationparking/front.html.twig', [
            'reservationparkings' => $reservationparkings,
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

    /**
     * @Route ("/stats",name="stats")
     */

    public function statistiques(){
        return$this->render('reservationparking/stats.html.twig');



    }
}

