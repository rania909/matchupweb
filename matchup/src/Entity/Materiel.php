<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
    public $idMateriel;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="nom_terrain", type="string", length=50, nullable=false)
     */
    public $nomTerrain;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="type_mat", type="string", length=50, nullable=false)
     */
    public $typeMat;

    /**
     * @var int
     * @Assert\NotBlank
     * @ORM\Column(name="quant_mat", type="integer", nullable=false)
     */
    public $quantMat;

    /**
     * @var \Terrain
     *
     * @ORM\ManyToOne(targetEntity="Terrain")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_terrain", referencedColumnName="id_terrain")
     * })
     */
    public $idTerrain;

    public function getIdMateriel(): ?int
    {
        return $this->idMateriel;
    }

    public function getNomTerrain(): ?string
    {
        return $this->nomTerrain;
    }

    public function setNomTerrain(string $nomTerrain): self
    {
        $this->nomTerrain = $nomTerrain;

        return $this;
    }

    public function getTypeMat(): ?string
    {
        return $this->typeMat;
    }

    public function setTypeMat(string $typeMat): self
    {
        $this->typeMat = $typeMat;

        return $this;
    }

    public function getQuantMat(): ?int
    {
        return $this->quantMat;
    }

    public function setQuantMat(int $quantMat): self
    {
        $this->quantMat = $quantMat;

        return $this;
    }

    public function getIdTerrain(): ?Terrain
    {
        return $this->idTerrain;
    }

    public function setIdTerrain(?Terrain $idTerrain): self
    {
        $this->idTerrain = $idTerrain;

        return $this;
    }


}
