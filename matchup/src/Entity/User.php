<?php



namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("users:read")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Groups("users:read")
     */
    public $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Groups("users:read")
     */
    public $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     *@Groups("users:read")
     */
    public $email;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Groups("users:read")
     */
    public $mdp;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Groups("users:read")
     */
    public $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer", nullable=false)
     * @Assert\NotBlank
     * @Groups("users:read")
     */
    public $age;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=20, nullable=false)
     * @Assert\NotBlank
     * @Groups("users:read")
     */
    public $genre;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_terrain", type="integer", nullable=false)
     * @Groups("users:read")
     */
    public $nbTerrain = 0;

    /**
     *  * @var string
     *
     * @ORM\Column(name="role", type="text", length=0, nullable=true)
     *@Groups("users:read")
     */
    public $role = "null";

    /**
     * @ORM\Column(type="json")
     * @Groups("users:read")
     */
    public $roles = ["ROLE_UTI"];
    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_verified", type="boolean", nullable=true)
     * @Groups("users:read")
     */

    public $isVerified = false;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @param string $nom
     * @return User
     */
    public function setNom(string $nom): User
    {
        $this->nom = $nom;
        return $this;
    }


    /**
     * @param string $prenom
     * @return User
     */
    public function setPrenom(string $prenom): User
    {
        $this->prenom = $prenom;
        return $this;
    }


    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }


    /**
     * @param string $mdp
     * @return User
     */
    public function setMdp(string $mdp): User
    {
        $this->mdp = $mdp;
        return $this;
    }


    /**
     * @param string $adresse
     * @return User
     */
    public function setAdresse(string $adresse): User
    {
        $this->adresse = $adresse;
        return $this;
    }


    /**
     * @param int $age
     * @return User
     */
    public function setAge(int $age): User
    {
        $this->age = $age;
        return $this;
    }


    /**
     * @param string $genre
     * @return User
     */
    public function setGenre(string $genre): User
    {
        $this->genre = $genre;
        return $this;
    }


    /**
     * @param int $nbTerrain
     * @return User
     */
    public function setNbTerrain(int $nbTerrain): User
    {
        $this->nbTerrain = $nbTerrain;
        return $this;
    }


    /**
     * @param string $role
     * @return User
     */
    public function setRole(string $role): User
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @see UserInterface
     */

    public function getUsername()
    {
        return $this->email;
    }

    public function getPassword():?string
    {
        return (string)$this->mdp;
    }

    public function setPassword(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }


    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {

    }


    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_UTI';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    /**
     * @return bool
     */
    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    /**
     * @param bool|null $isVerified
     * @return User
     */
    public function setIsVerified(?bool $isVerified): User
    {
        $this->isVerified = $isVerified;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * @return string
     */
    public function getLogin(): ?string
    {
        return $this->email;
    }
//...//
    protected $captchaCode;

    /**
     * @return mixed
     */
    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    /**
     * @param mixed $captchaCode
     * @return User
     */
    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getAdresse(): string
    {
        return $this->adresse;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * @return int
     */
    public function getNbTerrain(): int
    {
        return $this->nbTerrain;
    }

    /**
     * @return bool|null
     */
    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    /**
     * @return string
     */
    public function getRole(): ?string
    {
        return $this->role;
    }



}