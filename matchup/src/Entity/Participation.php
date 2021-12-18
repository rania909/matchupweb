<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticipationRepository::class)
 */
class Participation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=matchs::class, inversedBy="participations")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id_match")
     */
    private $matchs;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="participations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatchs(): ?matchs
    {
        return $this->matchs;
    }

    public function setMatchs(?matchs $matchs): self
    {
        $this->matchs = $matchs;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }
}
