<?php

namespace App\Controller;

use App\Entity\Matchs;
use App\Form\MatchsType;
use App\Repository\MatchsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use MercurySeries\FlashyBundle\MercurySeriesFlashyBundle;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * @Route("/matchs")
 */
class MatchsController extends AbstractController
{
    /**
     * @Route("/addMatchsJSON", name="addMatchsJSON")
     */
    public function addMatchsJSON( Request $request ,NormalizerInterface $normalizer ){
        $em=$this->getDoctrine()->getManager();
        $match=new Matchs();
        $match->setDate(new \DateTime($request->get('date')));
        $match->setNbjoueurs($request->get('nbjoueurs'));
        $match->setType($request->get('type'));
        $em -> persist($match);
        $em->flush();
        $jsonContent=$normalizer->normalize($match,'json',['groups'=>'match']);
        return new Response("Match ajouté".json_encode($jsonContent));

    }
    /**
     * @Route("/listmatchs", name="listmatchs")
     */
    public function getmatchs()
    {

        $match=$this->getDoctrine()->getManager()
            ->getRepository(Matchs::class)
            ->findAll();

        $data =  array();
        foreach ($match as $key => $p){
            //$data[$key]['ref_p']= $p->getRefP();
            $data[$key]['idMatch']= $p->getIdMatch();
            $data[$key]['date']= $p->getDate();
            $data[$key]['type']= $p-> getType();
            $data[$key]['nbjoueurs']= $p->getNbjoueurs();


        }

        return new JsonResponse($data);

    }

    /**
     * @Route("/list", name="list_match", methods={"GET"})
     */
    public function list(): Response
    {
        $matchs = $this->getDoctrine()
            ->getRepository(Matchs::class)
            ->findAll();

        return $this->render('matchs/list.html.twig', [
            'matchs' => $matchs,
        ]);
    }
    /**
     * @Route("/", name="matchs_index", methods={"GET"})
     */

    public function index(MatchsRepository $repository ,Request $request, PaginatorInterface $paginator )
    {
        $donnees = $this->getDoctrine()
            ->getRepository(Matchs::class)
            ->findBy([]);
        $matchs=$paginator->paginate(
            $donnees, //on passe les donnees
            $request->query->getInt('page',1),
            4
        );
        return $this->render('matchs/index.html.twig',
            ['matchs' => $matchs]);
    }

    /**
     * @Route("/new", name="matchs_new", methods={"GET","POST"})
     */
    public function new(Request $request,FlashyNotifier $flashy): Response
    {
        $match = new Matchs();
        $form = $this->createForm(MatchsType::class, $match);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flashy->success('Match Ajouté!', 'http://your-awesome-link.com');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($match);
            $entityManager->flush();

            return $this->redirectToRoute('matchs_index');
        }

        return $this->render('matchs/new.html.twig', [
            'match' => $match,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idMatch}", name="matchs_show", methods={"GET"})
     */
    public function show(Matchs $match): Response
    {
        return $this->render('matchs/show.html.twig', [
            'match' => $match,
        ]);
    }

    /**
     * @Route("/newfront", name="new_front", methods={"GET"})
     */
    public function newfront(): Response
    {
        $matchs = $this->getDoctrine()
            ->getRepository(Matchs::class)
            ->findAll();

        return $this->render('matchs/newfront.html.twig', [
            'matchs' => $matchs,
        ]);
    }

}
