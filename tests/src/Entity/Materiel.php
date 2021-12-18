<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Materiel
 *
 * @ORM\Table(name="materiel", indexes={@ORM\Index(name="fk_nter", columns={"id_terrain"})})
 * @ORM\Entity
 */
class Materiel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_materiel", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMateriel;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_terrain", type="string", length=50, nullable=false)
     */
    private $nomTerrain;

    /**
     * @var string
     *
     * @ORM\Column(name="type_mat", type="string", length=50, nullable=false)
     */
    private $typeMat;

    /**
     * @var int
     *
     * @ORM\Column(name="quant_mat", type="integer", nullable=false)
     */
    private $quantMat;

    /**
     * @var \Terrain
     *
     * @ORM\ManyToOne(targetEntity="Terrain")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_terrain", referencedColumnName="id_terrain")
     * })
     */
    private $idTerrain;


}
