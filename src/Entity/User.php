<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={
 *         "post"={
 *             "method"="POST",
 *             "path"="/users/register",
 *             "controller"=App\Controller\RegisterUserController::class,
 *             "normalization_context"={"groups"={"user:read"}},
 *             "denormalization_context"={"groups"={"user:write"}},
 *             "validation_groups"={"Default", "user:create"},
 *             "security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"
 *         },
 *         "get"
 *     },
 *     itemOperations={
 *         "get"={
 *             "security"="is_granted('IS_AUTHENTICATED_FULLY') and object == user"
 *         }
 *     }
 * )
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $username;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @ORM\Column(type="string")
     */
    private string $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt()
    {
        // Not needed when using bcrypt
    }

    public function eraseCredentials()
    {
        // Not needed when using bcrypt
    }

    public function getUserIdentifier(): string
    {
        return $this->getUsername();
    }
}
