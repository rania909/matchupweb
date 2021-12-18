<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\Repository;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * Matchs
 * @ORM\Table(name="matchs", indexes={@ORM\Index(name="id_terrain", columns={"id_terrain"})})
 * @ORM\Entity
 */
class Matchs
{
    /**
     *
     * @var int
     *
     * @ORM\Column(name="id_match", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $idMatch;

    /**
     * @var string
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="ce champ est obligatoire")
     * @Assert\Type(
     *     type="string",
     *     message="la valeur n'est pas valide {{ type }}."
     * )
     */
    public $type;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="ce champ est obligatoire")
     * @ORM\Column(name="date", type="date", nullable=false)
     * @Assert\DateTime
     * @var string A "Y-m-d " formatted value
     */
    public $date;

    /**
     * @var int
     * @ORM\Column(name="nbjoueurs", type="integer", nullable=false)
     * @Assert\NotBlank(message="ce champ est obligatoire")
     * @Assert\Positive(
     *     message="le nombre de joueurs {{ value }} est invalide"
     * )
     *
     */
    public $nbjoueurs;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_tournoi", type="string", length=255, nullable=false)
     */
    public $nomTournoi;

    /**
     * @var \Tournoi
     *
     * @ORM\ManyToOne(targetEntity=Tournoi::class, inversedBy="Matchs")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_tournoi", referencedColumnName="id_tournoi")
     * })
     */

    public $idTournoi;

    /**
     * @return int
     */
    public function getIdTournoi(): ?int
    {
        return $this->idTournoi;
    }

    /**
     * @param \Tournoi $idTournoi
     * @return Matchs
     */
    public function setIdTournoi( $idTournoi)
    {
        $this->idTournoi = $idTournoi;
        return $this;
    }

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
     * @return int
     */
    public function getIdMatch(): int
    {
        return $this->idMatch;
    }

    /**
     * @param int $idMatch
     * @return Matchs
     */
    public function setIdMatch(int $idMatch): Matchs
    {
        $this->idMatch = $idMatch;
        return $this;
    }



    /**
     * @param string $type
     * @return Matchs
     */
    public function setType(string $type): Matchs
    {
        $this->type = $type;
        return $this;
    }


    /**
     * @param \DateTime $date
     * @return Matchs
     */
    public function setDate(\DateTime $date): Matchs
    {
        $this->date = $date;
        return $this;
    }



    /**
     * @param int $nbjoueurs
     * @return Matchs
     */
    public function setNbjoueurs(int $nbjoueurs): Matchs
    {
        $this->nbjoueurs = $nbjoueurs;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomTournoi(): string
    {
        return $this->nomTournoi;
    }

    /**
     * @param string $nomTournoi
     * @return Matchs
     */
    public function setNomTournoi(string $nomTournoi): Matchs
    {
        $this->nomTournoi = $nomTournoi;
        return $this;
    }



    /**
     * @return \Terrain
     */
    public function getIdTerrain(): \Terrain
    {
        return $this->idTerrain;
    }

    /**
     * @param \Terrain $idTerrain
     * @return Matchs
     */
    public function setIdTerrain(\Terrain $idTerrain): Matchs
    {
        $this->idTerrain = $idTerrain;
        return $this;
    }

    /**
     * @return Collection|Participation[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participation $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->setMatchs($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): self
    {
        if ($this->participations->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getMatchs() === $this) {
                $participation->setMatchs(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getNbjoueurs(): ?int
    {
        return $this->nbjoueurs;
    }

    public function __toString(): ?string
    {
        return $this->idTournoi;
    }

}
