<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resterrain
 *
 * @ORM\Table(name="resterrain", indexes={@ORM\Index(name="resterrain_ibfk_2", columns={"id"}), @ORM\Index(name="fk_idter", columns={"id_terrain"})})
 * @ORM\Entity
 */
class Resterrain
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rester", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $idRester;

    /**
     * @var string
     *
     * @ORM\Column(name="date_res", type="string", length=50, nullable=false)
     */
    public $dateRes;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_terrain", type="string", length=50, nullable=false)
     */
    public $nomTerrain;

    /**
     * @var \Terrain
     *
     * @ORM\ManyToOne(targetEntity="Terrain")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_terrain", referencedColumnName="id_terrain")
     * })
     */
    public $idTerrain;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    public $id;


}
