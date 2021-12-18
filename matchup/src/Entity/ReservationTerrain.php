<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationTerrain
 *
 * @ORM\Table(name="reservation_terrain", indexes={@ORM\Index(name="id", columns={"id"}), @ORM\Index(name="id_terrain", columns={"id_terrain"})})
 * @ORM\Entity
 */
class ReservationTerrain
{
    /**
     * @var int
     *
     * @ORM\Column(name="idrvsterrain", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrvsterrain;

    /**
     * @var int
     *
     * @ORM\Column(name="date_d", type="integer", nullable=false)
     */
    private $dateD;

    /**
     * @var int
     *
     * @ORM\Column(name="date_f", type="integer", nullable=false)
     */
    private $dateF;

    /**
     * @var int
     *
     * @ORM\Column(name="nbdejoueurs", type="integer", nullable=false)
     */
    private $nbdejoueurs;

    /**
     * @var \Terrain
     *
     * @ORM\ManyToOne(targetEntity="Terrain")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_terrain", referencedColumnName="id_terrain")
     * })
     */
    private $idTerrain;

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
