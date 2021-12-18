<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Form\SearchProduit1Type;
use App\Form\QuantityType;
use App\Form\SearchProduitType;
use App\Repository\ProduitRepository;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    /**
     *@Route("/panier1" ,name="cart_index")
     */
    public function index (SessionInterface $session, ProduitRepository $produitRepository) {
        $panier=$session->get('panier',[]);
        $panierWithData=[];
        foreach ($panier as $idProduit=>$quantite){
            $panierWithData []=['produit'=>$produitRepository->find($idProduit),
                'quantite'=>$quantite];

        }
        $total=0;
        foreach ($panierWithData as $item){
            $totalItem=$item['produit']->getPrix();
            $total+=$totalItem;
        }
        return $this->render('carte/index.html.twig',['items' => $panierWithData , 'total'=>$total] );

    }


    /**
     *@Route("/carte/add/{idProduit}",name="cart_add")
     */
    public function add($idProduit,Request $request,SessionInterface $session)
    {
        $panier=$session->get('panier',[]);
        if (!empty($panier[$idProduit])) {
            $panier[$idProduit]++;
        }else{

            $panier[$idProduit]=1 ; }
        $session->set('panier',$panier);

        return $this->redirectToRoute("cart_index");


    }
    /**
     * @Route("/Panier/remove{idProduit}" ,name="cart_remove")
     */
    public function remove($idProduit,SessionInterface $session){
        $panier=$session->get('panier',[]);
        if (!empty($panier[$idProduit])){
            unset($panier[$idProduit]);
        }
        $session->set('panier',$panier);

        $this->addFlash('message','Le message a bien ete envoye');
        $this->addFlash(
            'info' ,' product deleted !');

        return $this->redirectToRoute("cart_index");

    }
}