<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier", indexes={@ORM\Index(name="id_produit", columns={"id_produit"}), @ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Panier
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_panier", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $idPanier;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    public $id;

    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_produit", referencedColumnName="id_produit")
     * })
     */
    public $idProduit;

public $produit;
    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    /**
     * @return int
     */
    public function getIdPanier(): int
    {
        return $this->idPanier;
    }

    /**
     * @param int $idPanier
     * @return Panier
     */
    public function setIdPanier(int $idPanier): Panier
    {
        $this->idPanier = $idPanier;
        return $this;
    }

    /**
     * @return \User
     */
    public function getId(): \User
    {
        return $this->id;
    }

    /**
     * @param \User $id
     * @return Panier
     */
    public function setId(\User $id): Panier
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \Produit
     */
    public function getIdProduit(): \Produit
    {
        return $this->idProduit;
    }

    /**
     * @param \Produit $idProduit
     * @return Panier
     */
    public function setIdProduit(\Produit $idProduit): Panier
    {
        $this->idProduit = $idProduit;
        return $this;
    }

}
