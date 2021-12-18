<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parking
 *
 * @ORM\Table(name="parking", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Parking
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_parking", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $idParking;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    public $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="nbdeplace", type="integer", nullable=false)
     */
    public $nbdeplace;

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
     * @return int
     */
    public function getIdParking(): ?int
    {
        return $this->idParking;
    }

    /**
     * @param int $idParking
     * @return Parking
     */
    public function setIdParking(int $idParking): Parking
    {
        $this->idParking = $idParking;
        return $this;
    }


    /**
     * @return string
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     * @return Parking
     */
    public function setAdresse(string $adresse): Parking
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbdeplace(): ?int
    {
        return $this->nbdeplace;
    }

    /**
     * @param int $nbdeplace
     * @return Parking
     */
    public function setNbdeplace(int $nbdeplace): Parking
    {
        $this->nbdeplace = $nbdeplace;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }




   // public function __toString(): ?string
    //{
      //  return $this->id;
   // }


}
