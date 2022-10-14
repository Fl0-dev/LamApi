<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Entity\Application\Application;
use App\Repository\UserRepositories\UserRepository;
use App\State\UserDataProvider;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid as BaseUuid;

#[ApiResource(operations: [
    new GetCollection(
        uriTemplate: '/users',
        // normalizationContext: ['getUsers'],
        provider: UserDataProvider::class,
    ),
])]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'app_user')]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap([
    "physical" => UserPhysical::class,
    "abstract" => UserAbstract::class
])]
abstract class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    public const OPERATION_NAME_GET_USERS = 'getUsers';

    public const TYPE_PHYSICAL = 'physical';
    public const TYPE_ABSTRACT = 'abstract';

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string', length: 180, nullable: true)]
    private $password;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $token;

    #[ORM\Column(type: "string", length: 180)]
    #[Groups([
        Application::OPERATION_NAME_POST_APPLICATION_BY_OFFER_ID,
    ])]
    private $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $mainType;

    public function __construct()
    {
        if ($this instanceof UserPhysical) {
            $this->mainType = self::TYPE_PHYSICAL;
        } elseif ($this instanceof UserAbstract) {
            $this->mainType = self::TYPE_ABSTRACT;
        }
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
