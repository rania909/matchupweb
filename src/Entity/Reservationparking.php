<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationparking
 *
 * @ORM\Table(name="reservationparking", indexes={@ORM\Index(name="id", columns={"id"}), @ORM\Index(name="reservationparking_ibfk_1", columns={"id_parking"})})
 * @ORM\Entity
 */
class Reservationparking
{
    /**
     * @var int
     *
     * @ORM\Column(name="idrsvparking", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $idrsvparking;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_d", type="date", nullable=false)
     */
    public $dateD;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_f", type="date", nullable=false)
     */
    public $dateF;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    public $email;

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
     * @var \Parking
     *
     * @ORM\ManyToOne(targetEntity="Parking")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parking", referencedColumnName="id_parking")
     * })
     */
    public $idParking;


}
