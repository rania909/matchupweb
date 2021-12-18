<?php

namespace App\Entity;

use DateTime;
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

    /**
     * @return int
     */
    public function getIdrsvparking(): int
    {
        return $this->idrsvparking;
    }

    /**
     * @param int $idrsvparking
     * @return Reservationparking
     */
    public function setIdrsvparking(int $idrsvparking): Reservationparking
    {
        $this->idrsvparking = $idrsvparking;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateD(): DateTime
    {
        echo  gettype($this->dateD);
        $date = new \DateTime('@'.strtotime('now'));
        if (gettype($this->dateD) === NULL)
        {return $this->dateD;}
        else{}
        return $date;
    }

    /**
     * @param \DateTime $dateD
     * @return App\Entity\Reservationparking
     */
    public function setDateD(\DateTime $dateD): Reservationparking
    {
        $this->dateD = $dateD;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateF(): ?DateTime
    {
        return $this->dateF;
    }

    /**
     * @param \DateTime $dateF
     * @return Reservationparking
     */
    public function setDateF(\DateTime $dateF): Reservationparking
    {
        $this->dateF = $dateF;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Reservationparking
     */
    public function setEmail(?string $email): Reservationparking
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return User
     */
    public function getId(): ?User
    {
        return $this->id;
    }

    /**
     * @param \User $id
     * @return Reservationparking
     */
    public function setId(\User $id): Reservationparking
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Parking
     */
    public function getIdParking(): ?Parking
    {
        return $this->idParking;
    }

    /**
     * @param \Parking $idParking
     * @return Reservationparking
     */
    public function setIdParking(\Parking $idParking): Reservationparking
    {
        $this->idParking = $idParking;
        return $this;
    }



}
