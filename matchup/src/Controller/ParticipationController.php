<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MatchsRepository;
use App\Repository\UserRepository;
use App\Repository\ParticipationRepository;
use App\Entity\Participation;
use App\Entity\Matchs;
use App\Entity\User;


class ParticipationController extends AbstractController
{
    /**
     * @Route("/participation", name="participation")
     */
    public function index(): Response
    {
        return $this->render('participation/index.html.twig', []);
    }

    /**
     * @param MatchsRepository $matchRepo
     * @Route ("/participation", name="participation")
     */
    public function affiche(MatchsRepository $matchRepo)
    {
        $matchs = $matchRepo->findAll();
        return $this->render('participation/index.html.twig', [
            'matchs' => $matchs,
        ]);
    }

    /**
     * @Route ("/match/{id}/details", name="matchdetails")
     */
    public function afficheMatch(UserRepository $userRepo, ParticipationRepository $participationRepo, MatchsRepository $matchRepo, $id)
    {
        $match = $matchRepo->find($id);
        $nom = 'user';
        $user = $userRepo->findOneByUsername($nom);

        $participated = false;
        $participation = $participationRepo->findOneByUserAndMatch($user, $match);
        if($participation != null) {
            $participated = true;
        }

        $participations = $match->getParticipations();
        if ($participations != null) {
            $matchParticipant = $participations->count();
        }

        $matchFull = false;
        if ($matchParticipant >= $match->getNbjoueurs()) {
            $matchFull = true;
        }

        return $this->render('participation/match-details.html.twig', [
            'match' => $match,
            'full' => $matchFull,
            'participated' => $participated
        ]);
    }

    /**
     * @Route ("/match/{id}/participate", name="matchparticipation")
     */
    public function participatematch(
        ParticipationRepository $participationRepo,
        MatchsRepository $matchRepo,
        UserRepository $userRepo,
        $id
    ) {

        $match = $matchRepo->find($id);

        $matchParticipant = 0;
        $participations = $match->getParticipations();
        if ($participations != null) {
            $matchParticipant = $participations->count();
        }

        if ($matchParticipant >= $match->getNbjoueurs()) {
            return $this->redirectToRoute('matchdetails', ['id' => $match->getIdMatch()]);
        }

        $em = $this->getDoctrine()->getManager();

        $username = 'user';
        $user = $userRepo->findOneByUsername($username);

        if ($user == null) {
            $client = new User();
            $client->setNom($username);

            $em->persist($client);
        }

        $participation = new Participation();
        $participation->setMatchs($match);
        $participation->setUser($user);

        $match->addParticipation($participation);
        $em->persist($participation);
        $em->persist($match);
        $em->flush();

        return $this->redirectToRoute('matchdetails', ['id' => $match->getIdMatch()]);
    }
}
