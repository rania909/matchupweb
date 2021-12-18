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
    private $idrsvparking;

    /**
     * @var string
     *
     * @ORM\Column(name="date_d", type="string", length=255, nullable=false)
     */
    private $dateD;

    /**
     * @var string
     *
     * @ORM\Column(name="date_f", type="string", length=255, nullable=false)
     */
    private $dateF;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $email = 'NULL';

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;

    /**
     * @var \Parking
     *
     * @ORM\ManyToOne(targetEntity="Parking")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parking", referencedColumnName="id_parking")
     * })
     */
    private $idParking;


}
