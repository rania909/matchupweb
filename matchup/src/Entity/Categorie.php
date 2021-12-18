<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use App\Form\CategorieType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use MercurySeries\FlashyBundle\MercurySeriesFlashyBundle;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormView;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_categorie", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $idCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_categorie", type="string", length=255)
     * @Assert\Length(min=5, max=50)
     * @Assert\NotBlank(message="le nom est requis")
     */
    public $nomCategorie;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="idCategorie")
     */
    public $produits;


    public function getIdCategorie(): ?int
    {
        return $this->idCategorie;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function __toString(): ?string
    {
        return $this->idCategorie;
    }
    /**
     * @return Collection|Produit[]
     */
    public function getProduit(): Collection
    {
        return $this->produits;
    }

    public function addCategorie(Categorie $categorie): self
    {
        if (!$this->student->contains($categorie)) {
            $this->categorie[] = $categorie;
            $categorie->setIdCategorie($this);
        }

        return $this;
    }

    public function removecategorie(categorie $categorie): self
    {
        if ($this->categorie->removeElement($categorie)) {
            // set the owning side to null (unless already changed)
            if ($categorie->getIdCategorie() === $this) {
                $categorie->setIdCategorie(null);
            }
        }

        return $this;
    }






    
}
