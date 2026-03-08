<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RecapsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecapsRepository::class)]
#[ApiResource]
class Recaps
{

    // use TimeStampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?array $performance = null;

    public function getId(): ?int
    {
        return $this->id;
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
