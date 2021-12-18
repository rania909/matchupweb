<?php

namespace App\Controller;

use App\Classe\Search;
use App\Data\SearchData;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Form\SearchType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use MercurySeries\FlashyBundle\MercurySeriesFlashyBundle;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCodeBundle\Response\QrCodeResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * @Route("/produit")
 */
class ProduitController extends AbstractController
{
    /**
     * @Route("/getproduct", name="getproduct")
     */
    public function getProdDetailsJsonAction()
    {

        $produit=$this->getDoctrine()->getManager()
            ->getRepository(Produit::class)
            ->findAll();

        $data =  array();
        foreach ($produit as $key => $p){
            //$data[$key]['ref_p']= $p->getRefP();
            $data[$key]['idProduit']= $p->getIdProduit();
            $data[$key]['nom_produit']= $p->getNomProduit();
            $data[$key]['prix']= $p->getPrix();
            $data[$key]['quantite_total']= $p->getQuantiteTotal();
            $data[$key]['quantite_restant']= $p->getQuantiteRestant();
            //echo $data[$key]['nomP'];
            $data[$key]['description']= $p->getDescription();
            $data[$key]['path']= $p->getPath();

        }

        return new JsonResponse($data);

    }
    /**
     * @Route("/front", name="front")
     * @param ProduitRepository $repository
     * @param Request $request
     * @return Response
     */
    public function front(ProduitRepository $repository, Request $request,PaginatorInterface $paginator){
        $data = new SearchData();
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $produits = $repository->findSearch($data);
        $produits = $paginator->paginate(
            $produits,
            $request->query->getInt('page',1),
            3
        );
        return $this->render('produit/frontproduit.html.twig', [
            'produits' => $produits,
            'form' => $form->createView()
        ]);

    }
    /**
     * @Route("/triproduit", name="triproduit")
     */
    public function Tri(Request $request,PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();


        $query = $em->createQuery(
            'SELECT n FROM App\Entity\Produit n
            ORDER BY n.nomProduit '
        );

        $produits = $query->getResult();

        $produits = $paginator->paginate(
            $produits,
            $request->query->getInt('page',1),
            4
        );

        return $this->render('produit/index.html.twig',
            array('produits' => $produits));

    }
    /**
     * @Route("/imprimeproduit", name="imprimeproduit")
     */
    public function imprimeproduit(ProduitRepository $ProduitRepository): Response

    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $produits = $ProduitRepository->findAll();

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('produit/imprimeproduit.html.twig', [
            'produits' => $produits,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("Liste  produit.pdf", [
            "Attachment" => true
        ]);
    }


    /**
     * @Route("/statpro", name="statpro")
     */
    public function stat(){

        $repository = $this->getDoctrine()->getRepository(Produit::class);
        $produit = $repository->findAll();

        $pro = $this->getDoctrine()->getManager();

        $c1=0;
        $c2=2;
        $c3=1;


        foreach ($produit as $produit)
        {
            if (  $produit->getIdCategorie()=="Protéine")  :

                $c1+=1;
            elseif ($produit->getIdCategorie()=="Vêtement"):

                $c2+=1;
            else :
                $c3 +=1;

            endif;

        }
        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Categories', 'Nombre'],
                ['Materiel',  $c1],
                ['Vêtement',  $c2],
                ['Protéine',  $c3],

            ]
        );
        $pieChart->getOptions()->setTitle('Top Catégories');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('produit/stat.html.twig', array('piechart' => $pieChart));
    }

    /**
     * @Route("/", name="produit_index", methods={"GET"})
     */
    public function index(Request $request , PaginatorInterface $paginator): Response
    {
        $produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();
        $produits = $paginator->paginate(
            $produits,
            $request->query->getInt('page',1),
            3
        );

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,

        ]);
    }
    /**
     * @Route("/new", name="produit_new", methods={"GET","POST"})
     */
    public function new(Request $request,FlashyNotifier $flashy ): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flashy->success('Produit créée 😍 ', 'http://your-awesome-link.com');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produit_index');
        }

        return $this->render('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idProduit}", name="produit_show", methods={"GET"})
     */
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/{idProduit}/edit", name="produit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Produit $produit,FlashyNotifier $flashy): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flashy->warning('Produit modifié "Bien" ! ', 'http://your-awesome-link.com');
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produit_index');
        }

        return $this->render('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idProduit}", name="produit_delete", methods={"POST"})
     */
    public function delete(Request $request, Produit $produit,FlashyNotifier $flashy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getIdProduit(), $request->request->get('_token'))) {
            $flashy->error('Produit supprimée  :( ', 'http://your-awesome-link.com');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produit_index');
    }






}
