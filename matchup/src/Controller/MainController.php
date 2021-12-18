<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use App\Repository\MatchsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(MatchsRepository  $calendar)
    {
        $events = $calendar->findAll();

        $matchs=[];
        foreach ($events as $event) {
            $matchs[] = [
                'id' => $event->getIdMatch(),
                'date' => $event->getDate()->format('Y-m-d H:i:s'),
                'type' => $event->getNbjoueurs(),
                'title' => $event->getType(),



            ];
        }
        $data= json_encode($matchs);
        return $this->render('main/index.html.twig', compact('data'));
    }
}
