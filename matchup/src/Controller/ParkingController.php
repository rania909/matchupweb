<?php

namespace App\Controller;

use App\Entity\Parking;
use App\Form\ParkingType;

use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/parking")
 */
class ParkingController extends AbstractController
{
    /**
     * @Route("/", name="parking_index", methods={"GET"})
     */
    public function index( Request $request, PaginatorInterface $paginator)
    {
        $donnees = $this->getDoctrine()
            ->getRepository(Parking::class)
            ->findAll();

        $parkings=$paginator->paginate(
            $donnees, //on passe les donnees
            $request->query->getInt('page',1),
            2
        );

        return $this->render('parking/index.html.twig',[
            'parkings' => $parkings,
            ]);
    }






    /**
     * @Route("/new", name="parking_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $parking = new Parking();
        $form = $this->createForm(ParkingType::class, $parking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parking);
            $entityManager->flush();

            return $this->redirectToRoute('parking_index');
        }

        return $this->render('parking/new.html.twig', [
            'parking' => $parking,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/fronte", name="fronte_parking", methods={"GET"})
     */
    public function front(): Response
    {
        $parkings= $this->getDoctrine()
            ->getRepository(parking::class)
            ->findAll();

        return $this->render('parking/fronte.html.twig', [
            'parking' => $parkings,
        ]);
    }

    /**
* @Route("/listp/{idParking}", name="parking_listp", methods={"GET"})
*/
public function listp(parking $parking ) :Response

{
    // Configure Dompdf according to your needs
    $pdfOptions = new Options();
    $pdfOptions->set('isphpEnabled', 'true');

    // Instantiate Dompdf with our options
    $dompdf = new Dompdf($pdfOptions);




    // Retrieve the HTML generated in our twig file
    $html = $this ->renderView('parking/listp.html.twig', [
        'parking' => $parking,
    ]);

    // Load HTML to Dompdf
    $dompdf->loadHtml($html);


    // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();


$dompdf->stream("mypdf.pdf", [
    "Attachment" => true
]);
}





    /**
     * @Route("/{idParking}/edit", name="parking_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Parking $parking): Response
    {
        $form = $this->createForm(ParkingType::class, $parking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parking_index');
        }

        return $this->render('parking/edit.html.twig', [
            'parking' => $parking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idParking}", name="parking_delete", methods={"POST"})
     */
    public function delete(Request $request, Parking $parking): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parking->getIdParking(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($parking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('parking_index');
    }
    /**
     * @Route("/recherche", name="recherche" , methods={"GET"})
     */


    public function recherchebyadresseAction( Request $request)
    {
        $ad=$this->getDoctrine()->getManager();
        $parking=$ad->getRepository(parking::class)->findAll();
        if( $request ->isMethod("Post"))
        {
            $adresse=$request->get('adresse');
            echo  $adresse;
            $parking=$ad->getRepository("parking")->findAll(array('adresse'=>$adresse ,'adresse'=>'ASC'));
        }
        return $this->render("parking/recherche.html.twig",array("parkings"=>$parking));


    }


    /**
     * @Route("/{idParking}", name="parking_show", methods={"GET"})
     */
    public function show(Parking $parking): Response
    {
        return $this->render('parking/show.html.twig', [
            'parking' => $parking,
        ]);
    }
}





