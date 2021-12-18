<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Tournoi
 *
 * @ORM\Table(name="tournoi", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Tournoi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_tournoi", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $idTournoi;

    /**
     * @var string
     * @ORM\Column(name="nom_tournoi", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="ce champ est obligatoire")
     */
    public $nomTournoi;

    /**
     * @var string
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     * @Assert\Type(
     *     type="string",
     *     message="la valeur n'est pas valide {{ type }}."
     * )
     * @Assert\NotBlank(message="ce champ est obligatoire")
     */
    public $type;

    /**
     * @var \User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    public $id;

    /**
     * @return int
     */
    public function getIdTournoi(): int
    {
        return $this->idTournoi;
    }

    /**
     * @param int $idTournoi
     * @return Tournoi
     */
    public function setIdTournoi(int $idTournoi): Tournoi
    {
        $this->idTournoi = $idTournoi;
        return $this;
    }


}
