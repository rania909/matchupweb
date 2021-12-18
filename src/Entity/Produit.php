<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="id_categorie", columns={"id_categorie"}), @ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var
     *
     * @ORM\Column(name="id_produit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public  $idProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_produit", type="string", length=255, nullable=false)
     */
    public  $nomProduit;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    public  $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite_total", type="integer", nullable=false)
     */
    public  $quantiteTotal;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite_restant", type="integer", nullable=false)
     */
    public  $quantiteRestant;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    public  $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    public  $path = 'NULL';

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    public  $id;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categorie", referencedColumnName="id_categorie")
     * })
     */
    public  $idCategorie;


}
