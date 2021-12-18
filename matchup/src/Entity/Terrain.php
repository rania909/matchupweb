<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * Terrain
 * @ORM\Entity(repositoryClass="App\Repository\TerrainRepository")
 * @ORM\Table(name="terrain", indexes={@ORM\Index(name="id", columns={"id"})})
 *
 */
class Terrain
{
    /**
     * @var int
     * @Groups("terrains:read")
     * @ORM\Column(name="id_terrain", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $idTerrain;

    /**
     * @var string
     * @Assert\NotBlank
     * @Groups("terrains:read")
     *
     * @ORM\Column(name="nom_terrain", type="string", length=255, nullable=false)
     */
    public $nomTerrain;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="emplacement", type="string", length=225, nullable=false)
     * @Groups("terrains:read")
     */
    public $emplacement;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     * @Groups("terrains:read")
     */
    public $type;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="etat", type="string", length=255, nullable=false)
     * @Groups("terrains:read")
     */
    public $etat;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @Groups("terrains:read")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    public $id;

    /**
     * @return int
     */
    protected $captchaCode;


    public function getIdTerrain(): int
    {
        return $this->idTerrain;
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

    public function getEmplacement(): ?string
    {
        return $this->emplacement;
    }

    public function setEmplacement(string $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getId(): ?User
    {
        return $this->id;
    }

    public function setId(?User $id): self
    {
        $this->id = $id;

        return $this;
    }
    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;
    }
}
