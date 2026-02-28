<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\TimeStampTrait;
use App\Entity\UserEntity;
use App\Repository\RecapsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecapsRepository::class)]
#[ApiResource]
class RecapsEntity
{

    use TimeStampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'createdAt')]
    #[ORM\JoinColumn(nullable: false)]
    private ?UserEntity $user = null;

    #[ORM\Column(nullable: true)]
    private ?array $performance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?UserEntity
    {
        return $this->user;
    }

    public function setUser(?UserEntity $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getPerformance(): ?array
    {
        return $this->performance;
    }

    public function setPerformance(?array $performance): static
    {
        $this->performance = $performance;

        return $this;
    }
}
