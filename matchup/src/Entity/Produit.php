<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="id_categorie", columns={"id_categorie"}), @ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Produit
{
    /**
     * @var
     *
     * @ORM\Column(name="id_produit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("products:read")
     */
    public  $idProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_produit", type="string", length=255, nullable=false)
     * @Groups("products:read")
     * @Assert\NotBlank(message="le nom est requis")
     */
    public  $nomProduit;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     * @Groups("products:read")
     * @Assert\Positive
     */
    public  $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite_total", type="integer", nullable=false)
     * @Groups("products:read")
     * @Assert\Positive
     */
    public  $quantiteTotal;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite_restant", type="integer", nullable=false)
     * @Groups("products:read")
     * @Assert\Positive
     */
    public  $quantiteRestant;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * @Groups("products:read")
     */
    public  $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Groups("products:read")
     */
    public  $path;
    /**
     * @Vich\UploadableField(mapping="products", fileNameProperty="path")
     * @var File|null
     * @Groups("products:read")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     * @Groups("products:read")
     */
    public $updatedAt;

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     * @Groups("products:read")
     */
    public  $id;


    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="produits")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_categorie", referencedColumnName="id_categorie")
     * })
     * @Groups("products:read")
     */
    public  $idCategorie;

    /**
     * @return mixed
     */
    public function getIdProduit():?int
    {
        return $this->idProduit;
    }

    /**
     * @return string
     */
    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    /**
     * @return int
     */
    public function getPrix(): ?int
    {
        return $this->prix;
    }

    /**
     * @return int
     */
    public function getQuantiteTotal(): ?int
    {
        return $this->quantiteTotal;
    }

    /**
     * @return int
     */
    public function getQuantiteRestant(): ?int
    {
        return $this->quantiteRestant;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @return \User
     */
    public function getId(): \User
    {
        return $this->id;
    }

    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    /**
     * @param mixed $idProduit
     * @return Produit
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
        return $this;
    }

    /**
     * @param string $nomProduit
     * @return Produit
     */
    public function setNomProduit(string $nomProduit): Produit
    {
        $this->nomProduit = $nomProduit;
        return $this;
    }

    /**
     * @param int $prix
     * @return Produit
     */
    public function setPrix(int $prix): Produit
    {
        $this->prix = $prix;
        return $this;
    }

    /**
     * @param int $quantiteTotal
     * @return Produit
     */
    public function setQuantiteTotal(int $quantiteTotal): Produit
    {
        $this->quantiteTotal = $quantiteTotal;
        return $this;
    }

    /**
     * @param int $quantiteRestant
     * @return Produit
     */
    public function setQuantiteRestant(int $quantiteRestant): Produit
    {
        $this->quantiteRestant = $quantiteRestant;
        return $this;
    }

    /**
     * @param string $description
     * @return Produit
     */
    public function setDescription(string $description): Produit
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string|null $path
     * @return Produit
     */
    public function setPath(?string $path): Produit
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param \User $id
     * @return Produit
     */
    public function setId(\User $id): Produit
    {
        $this->id = $id;
        return $this;
    }

    public function setIdCategorie( Categorie $idCategorie):self
    {
        $this->idCategorie = $idCategorie;
        return $this;
    }
    public function __toString(): ?string
    {
        return $this->idCategorie;
    }


}
