<?php

namespace App\Controller;

use App\Entity\Livraison;
use App\Entity\Terrain;
use App\Form\TerrainType;
use App\Repository\TerrainRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Example;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/terrain")
 */
class TerrainController extends Controller
{
    /* AFFICHAGE DES TERRAINS JSON */

    /**
     * @Route("/allterrain", name="allterrain")
     */
    public function AllTerrain(NormalizerInterface $normalizer)
    {
        $repository = $this->getDoctrine()->getRepository(Terrain::class);
        $terrain = $repository->findAll();
        $jsonContent = $normalizer->normalize($terrain, 'json', ['groups' => 'terrains:read']);
        return $this->render('terrain/listterraintjson.html.twig', [
            'data' => $jsonContent,
        ]);
        return new Response(json_encode($jsonContent));

    }
    /* SUPP DES TERRAIN JSON */
    /**
     * @Route("/deleteTerrainJSON/{idTerrain}", name="deleteTerrainJSON")
     */
    public function deleteTerrainJSON( Request $request ,NormalizerInterface $normalizer , $idTerrain){
        $em=$this->getDoctrine()->getManager();
        $terrain=$em->getRepository(Terrain::class)->find($idTerrain);
        $em->remove($terrain);
        $em->flush();
        $jsonContent=$normalizer->normalize($terrain,'json',['groups'=>'terrains']);
        return new Response("terrain supprimée  ".json_encode($jsonContent));

    }
    /* AJOUTER TERRAIN JSON */
    /**
     * @Route("/addTerrainJSON", name="addTerrain")
     */
    public function addTerrainJSON( Request $request ,NormalizerInterface $normalizer ){
        $em=$this->getDoctrine()->getManager();
        $terrain=new Terrain();

        $terrain->setEtat($request->get('etat'));
        $terrain->setNomTerrain($request->get('nomTerrain'));
        $terrain->setEmplacement("tunis");
        $terrain->setType($request->get('type'));

        $em -> persist($terrain);
        $em->flush();
        $jsonContent=$normalizer->normalize($terrain,'json',['groups'=>'terrains']);
        return new Response("terrain ajoutéé".json_encode($jsonContent));

    }
    /* MODIFIER TERRAIN JSON */

    /**
     * @Route("/updateTerrainJSON/{idTerrain}", name="updateTerrainJSON")
     */
    public function updateTerrainJSON( Request $request ,NormalizerInterface $normalizer , $idTerrain){
        $em=$this->getDoctrine()->getManager();
        $terrain=$em->getRepository(Terrain::class)->find($idTerrain);
        $terrain->setType($request->get('type'));
        $terrain->setEmplacement('Tunis');
        $terrain->setEtat('Disponible');
        $terrain->setNomTerrain('Camp');
        $em->flush();
        $jsonContent=$normalizer->normalize($terrain,'json',['groups'=>'terrains']);
        return new Response("terrain modifieé  ".json_encode($jsonContent));
    }



    /**
     * @Route("/tri", name="tri",methods={"GET","POST"} )
     * @param TerrainRepository $TerrainRepository
     * @param Request $request
     * @return Response
     */
    public function tri(TerrainRepository $TerrainRepository,Request $request): Response
    {
        $terrains = $this->getDoctrine()
            ->getRepository(Terrain::class)
            ->listOrderByetat();
        if($request->isMethod("POST"))
        {
            $value=$request->get('Recherche');
            $terrains = $this->getDoctrine()->getRepository(Terrain::class)->findTerrainByName($value);

            return $this->render('terrain/rech.html.twig', [
                'terrains' => $terrains,

            ]);

        }
        $Allterrains =$TerrainRepository->findAll();
        $terrains = $this->get('knp_paginator')->paginate(
        // Doctrine Query, not results
            $Allterrains,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            4
        );

        return $this->render('terrain/index.html.twig', [
            'terrains' => $terrains,
        ]);
    }

    /**
     * @Route("/stat", name="stat")
     */

    public function list1( )
    {  $i=0;
        $count=[];
        $experience = $this->getDoctrine()->getRepository(Terrain::class)->findAll();
        $endroit=['tunis','sousse','beja'];
        foreach($endroit as $end)
        {
            $i=0;
            foreach($experience as $exp)
            {
                if($exp->getEmplacement()==$end){
                    $i=$i+1;


                }

            }
            $count[]=$i;

        }


        return   $this->render('terrain/stat.html.twig', ['endroit'=>json_encode($endroit),'count'=>json_encode($count)]);




    }
    /**
     * @Route("/", name="terrain_index", methods={"GET","POST"})
     * @param TerrainRepository $TerrainRepository
     * @param Request $request
     * @return Response
     */
    public function index(TerrainRepository $TerrainRepository,Request $request): Response
    {
        $terrains = $this->getDoctrine()
            ->getRepository(Terrain::class)
            ->findAll();
        if($request->isMethod("POST"))
        {
            $value=$request->get('Recherche');
            $terrains = $this->getDoctrine()->getRepository(Terrain::class)->findTerrainByName($value);

            return $this->render('terrain/rech.html.twig', [
                'terrains' => $terrains,

            ]);

        }
        $Allterrains =$TerrainRepository->findAll();
        $terrains = $this->get('knp_paginator')->paginate(
        // Doctrine Query, not results
            $Allterrains,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            4
        );

        return $this->render('terrain/index.html.twig', [
            'terrains' => $terrains,
        ]);
    }

    /**
     * @Route("/new", name="terrain_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $terrain = new Terrain();
        $form = $this->createForm(TerrainType::class, $terrain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($terrain);
            $entityManager->flush();

            return $this->redirectToRoute('terrain_index');
        }

        return $this->render('terrain/new.html.twig', [
            'terrain' => $terrain,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idTerrain}", name="terrain_show", methods={"GET"})
     */
    public function show(Terrain $terrain): Response
    {
        return $this->render('terrain/show.html.twig', [
            'terrain' => $terrain,
        ]);
    }

    /**
     * @Route("/{idTerrain}/edit", name="terrain_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Terrain $terrain): Response
    {
        $form = $this->createForm(TerrainType::class, $terrain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('terrain_index');
        }

        return $this->render('terrain/edit.html.twig', [
            'terrain' => $terrain,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idTerrain}", name="terrain_delete", methods={"POST"})
     */
    public function delete(Request $request, Terrain $terrain): Response
    {
        if ($this->isCsrfTokenValid('delete'.$terrain->getIdTerrain(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($terrain);
            $entityManager->flush();
        }

        return $this->redirectToRoute('terrain_index');
    }






}
