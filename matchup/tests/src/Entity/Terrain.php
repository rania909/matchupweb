<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Terrain
 *
 * @ORM\Table(name="terrain", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Terrain
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_terrain", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTerrain;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_terrain", type="string", length=255, nullable=false)
     */
    private $nomTerrain;

    /**
     * @var string
     *
     * @ORM\Column(name="emplacement", type="string", length=225, nullable=false)
     */
    private $emplacement;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=false)
     */
    private $etat;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;


}
