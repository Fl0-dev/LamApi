<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\UserInfoAction;
use App\Entity\Applicant\Applicant;
use App\Entity\Application\Application;
use App\Repository\UserRepositories\UserRepository;
use App\State\UserDataProvider;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Uid\Uuid as BaseUuid;
use Symfony\Component\Validator\Constraints\Length;

#[ApiResource(operations: [
    new GetCollection(
        security: 'is_granted("ROLE_ADMIN")',
        uriTemplate: '/users',
        provider: UserDataProvider::class,
    ),
    new Get(
        uriTemplate: '/user-info',
        controller: UserInfoAction::class,
        paginationEnabled: false,
        read: false,
        normalizationContext: ['groups' => [self::OPERATION_NAME_GET_USER_INFO]],
        openapiContext: [
            'tags' => ['User'],
            'summary' => 'Get user info',
        ],
    )
])]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'app_user')]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap([
    self::TYPE_PHYSICAL => UserPhysical::class,
    self::TYPE_ABSTRACT => UserAbstract::class,
    Employer::TYPE_EMPLOYER => Employer::class,
    Applicant::TYPE_APPLICANT => Applicant::class,
    UserAts::TYPE_ATS => UserAts::class,
    UserAdmin::TYPE_ADMIN => UserAdmin::class,
    UserJobBoard::TYPE_JOB_BOARD => UserJobBoard::class,
])]
abstract class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    public const OPERATION_NAME_GET_USERS = 'getUsers';
    public const OPERATION_NAME_GET_USER_INFO = 'getUserInfo';

    public const TYPE_PHYSICAL = 'physical';
    public const TYPE_ABSTRACT = 'abstract';

    #[ORM\Column(type: 'json')]
    #[Groups([
        self::OPERATION_NAME_GET_USERS,
        self::OPERATION_NAME_GET_USER_INFO,
    ])]
    private $roles = [];

    #[ORM\Column(type: 'string', length: 180, nullable: true)]
    #[Groups([
        Applicant::OPERATION_NAME_POST_APPLICANT,
    ])]
    #[Assert\NotNull]
    #[Length(
        min: 8,
        max: 180,
        minMessage: 'The password must contain at least {{ limit }} characters',
        maxMessage: 'The password must not exceed {{ limit }} characters'
    )]
    private $password;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $token;

    #[ORM\Column(type: "string", length: 180)]
    #[Groups([
        Application::OPERATION_NAME_POST_APPLICATION_BY_OFFER_ID,
        Applicant::OPERATION_NAME_GET_ALL_APPLICANTS,
        Applicant::OPERATION_NAME_POST_APPLICANT,
        self::OPERATION_NAME_GET_USER_INFO,
        UserPhysical::OPERATION_NAME_GET_LIGHT_APPLICANT_INFOS,
    ])]
    #[Assert\Email(
        message: 'The email "{{ value }}" is not a valid email.',
    )]
    private $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([
        self::OPERATION_NAME_GET_USER_INFO,
    ])]
    private $mainType;

    #[ORM\Column]
    private ?bool $active = null;

    public function __construct()
    {
        if ($this instanceof UserPhysical) {
            $this->mainType = self::TYPE_PHYSICAL;
        } elseif ($this instanceof UserAbstract) {
            $this->mainType = self::TYPE_ABSTRACT;
        }
        $this->createdDate = new DateTime();
        $this->lastModifiedDate = new DateTime();
        $this->active = true;
    }

    #[Groups([
        self::OPERATION_NAME_GET_USERS,
        Applicant::OPERATION_NAME_GET_ALL_APPLICANTS,
        self::OPERATION_NAME_GET_USER_INFO,
    ])]
    public function getCreatedDate(): ?DateTime
    {
        return $this->createdDate;
    }

    #[Groups([
        self::OPERATION_NAME_GET_USERS,
        self::OPERATION_NAME_GET_USER_INFO,
        UserPhysical::OPERATION_NAME_GET_LIGHT_APPLICANT_INFOS,
    ])]
    public function getId(): ?BaseUuid
    {
        return $this->id;
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

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
