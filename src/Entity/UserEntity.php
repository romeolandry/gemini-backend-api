<?php

namespace App\Entity;

use App\Entity\RecapsEntity;
use App\Entity\Traits\TimeStampTrait;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class UserEntity
{
    use TimeStampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    /**
     * @var Collection<int, RecapsEntity>
     */
    #[ORM\OneToMany(targetEntity: RecapsEntity::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $createdAt;

    public function __construct()
    {
        $this->createdAt = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection<int, RecapsEntity>
     */
    public function getCreatedAt(): Collection
    {
        return $this->createdAt;
    }

    public function addCreatedAt(RecapsEntity $createdAt): static
    {
        if (!$this->createdAt->contains($createdAt)) {
            $this->createdAt->add($createdAt);
            $createdAt->setUser($this);
        }

        return $this;
    }

    public function removeCreatedAt(RecapsEntity $createdAt): static
    {
        if ($this->createdAt->removeElement($createdAt)) {
            // set the owning side to null (unless already changed)
            if ($createdAt->getUser() === $this) {
                $createdAt->setUser(null);
            }
        }

        return $this;
    }
}
