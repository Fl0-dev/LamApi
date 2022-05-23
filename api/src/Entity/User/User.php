<?php

namespace App\Entity\User;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @ApiResource(
 *     itemOperations={
 *          "get"={
 *             "path"="/users/{id}",
 *             "swagger_context"={
 *                 "tags"={"User"}
 *             }
 *          }
 *     },
 *     collectionOperations={
 *         "post"={
 *             "path"="/users",
 *             "method"="POST",
 *             "swagger_context"={
 *                 "tags"={"User"},
 *                 "summary"={"Create a new user"}
 *             }
 *         },
 *         "get"={
 *             "path"="/users",
 *             "method"="GET",
 *             "swagger_context"={
 *                 "tags"={"User"}
 *             }
 *          }
 *     },
 * )
 *
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @var ArrayCollection<UserRole> User's roles
     *
     * @ORM\Column(type="json")
     */
    private $roles;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $lastname;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $apiToken;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->roles = new ArrayCollection();
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): ArrayCollection
    {
        $roles = $this->roles;

        if ($roles instanceof ArrayCollection) {
            $roles = $roles->toArray();
        }

        // guarantee every user at least has ROLE_USER
        $roles[] = UserRole::USER;
        $roles = array_unique($roles);

        return new ArrayCollection($roles);
    }

    public function setRoles($roles): self
    {
        if (is_array($roles)) {
            $roles = new ArrayCollection($roles);
        }

        if ($roles instanceof ArrayCollection) {
            $this->roles = $roles;
        }

        return $this;
    }

    public function addRole(UserRole $role): self
    {
        $this->roles->add($role);

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getApiToken(): ?string
    {
        return $this->apiToken;
    }

    public function setApiToken(?string $apiToken): self
    {
        $this->apiToken = $apiToken;

        return $this;
    }
}
