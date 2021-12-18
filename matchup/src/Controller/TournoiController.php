<?php

namespace App\Controller;

use App\Entity\Tournoi;
use App\Form\TournoiType;
use App\Repository\TournoiRepository;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
/**
 * @Route("/tournoi")
 */
class TournoiController extends AbstractController
{
    /**
     * @Route("/addTournoiJSON", name="addTournoiJSON")
     */
    public function addTournoiJSON( Request $request ,NormalizerInterface $normalizer ){
        $em=$this->getDoctrine()->getManager();
        $tournoi=new Tournoi();
        $tournoi->setNomTournoi($request->get('nomTournoi'));
        $tournoi->setType($request->get('type'));

        $em -> persist($tournoi);
        $em->flush();
        $jsonContent=$normalizer->normalize($tournoi,'json',['groups'=>'tournoi']);
        return new Response("Tournoi ajouté".json_encode($jsonContent));

    }


    /**
     * @Route("/listtournoi", name="liste_tournoi")
     */
    public function gettournoi(TournoiRepository $repo,SerializerInterface $serializerInterface)
    {
        $tournois=$repo->findAll();
        $json=$serializerInterface->serialize($tournois,'json', ['groups'=>'tournoi']);
        dump($json);
        die;
    }




    /**
     *@Route("/affichertournoi",name="affichertournoi", methods={"GET","POST"})
     */
    function  affichetournoi(TournoiRepository $tournoiRepository,Request $request){
        $tournoi = new Tournoi();
        $searchForm = $this->createForm(\App\Form\SearchType::class,$tournoi);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $nomTournoi = $searchForm['nomTournoi']->getData();
            $donnees = $tournoiRepository->search($nomTournoi);
            return $this->redirectToRoute('search', array('nomTournoi' => $nomTournoi));
        }
        $donnees = $this->getDoctrine()->getRepository(Tournoi::class)->findBy([],['nomTournoi' => 'desc']);

        return $this->render('tournoi_index', [
            'tournoi' => $donnees,
            array(
                'searchForm' => $searchForm->createView()
            )
        ]);
    }

    /**
     * @Route("/liste", name="tournoi_liste", methods={"GET"})
     */
    public function liste(TournoiRepository $TournoiRepository ) :Response

    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('isphpEnabled', 'true');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $tournois = $TournoiRepository->findAll();


        // Retrieve the HTML generated in our twig file
        $html = $this ->renderView('tournoi/liste.html.twig', [
            'tournois' => $tournois,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);


        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();


        $dompdf->stream("ListeProduit.pdf", [
            "Attachment" => true
        ]);
    }
    /**
     * @Route("/listetournoi", name="list_tournoi", methods={"GET"})
     */
    public function list(): Response
    {
        $tournois = $this->getDoctrine()
            ->getRepository(Tournoi::class)
            ->findAll();

        return $this->render('tournoi/listtournoi.html.twig', [
            'tournois' => $tournois,
        ]);
    }
    /**
     * @Route("/", name="tournoi_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $donnees = $this->getDoctrine()
            ->getRepository(Tournoi::class)
            ->findAll();
        $tournois =$paginator->paginate(
            $donnees, //on passe les donnees
            $request->query->getInt('page',1),
            4
        );
        return $this->render('tournoi/index.html.twig', [
            'tournois' => $tournois,
        ]);
    }



    /**
     * @Route("/new", name="tournoi_new", methods={"GET","POST"})
     */
    public function new(Request $request,FlashyNotifier $flashy): Response
    {
        $tournoi = new Tournoi();
        $form = $this->createForm(TournoiType::class, $tournoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flashy->success('Tournoi Ajouté!', 'http://your-awesome-link.com');
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
    public function edit(Request $request, Tournoi $tournoi,FlashyNotifier $flashy): Response
    {
        $form = $this->createForm(TournoiType::class, $tournoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flashy->success('Tournoi Modifié!', 'http://your-awesome-link.com');
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
    public function delete(Request $request, Tournoi $tournoi,FlashyNotifier $flashy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tournoi->getIdTournoi(), $request->request->get('_token'))) {
            $flashy->warning('Tournoi supprimée :( ', 'http://your-awesome-link.com');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tournoi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tournoi_index');
    }
    /**
     * @Route("/search/{nomTournoi}", name="search", methods={"GET","POST"})
     */
    public function search(TournoiRepository $tournoiRepository,$nomTournoi,Request $request): Response
    {
        $tournoi = new Tournois();
        $searchForm = $this->createForm(\App\Form\SearchType::class,$tournoi);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $nomTournoi = $searchForm['nomTournoi']->getData();
            $donnees = $tournoiRepository->search($nomTournoi);
            return $this->redirectToRoute('search', array('nomTournoi' => $nomTournoi));
        }
        $tournoi = $tournoiRepository->search($nomTournoi);
        return $this->render('tournoi_index', [
            'tournois' => $tournoi,
            'searchForm' => $searchForm->createView()
        ]);
    }


}
