<?php

namespace App\Entity;

use App\Repository\RelationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelationsRepository::class)]
class Relations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $id_from;

    #[ORM\Column(type: 'integer')]
    private $id_to;

    #[ORM\Column(type: 'string', length: 1)]
    private $status;

    #[ORM\Column(type: 'datetime')]
    private $since;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdFrom(): ?int
    {
        return $this->id_from;
    }

    public function setIdFrom(int $id_from): self
    {
        $this->id_from = $id_from;

        return $this;
    }

    public function getIdTo(): ?int
    {
        return $this->id_to;
    }

    public function setIdTo(int $id_to): self
    {
        $this->id_to = $id_to;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSince(): ?\DateTimeInterface
    {
        return $this->since;
    }

    public function setSince(\DateTimeInterface $since): self
    {
        $this->since = $since;

        return $this;
    }
}
