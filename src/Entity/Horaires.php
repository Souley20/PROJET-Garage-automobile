<?php

namespace App\Entity;

use App\Repository\HorairesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HorairesRepository::class)]
class Horaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $Jours = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $horairesOuverturesMatin = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $horairesFermeturesMatin = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $horairesOuverturesSoir = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $horairesFermeturesSoir = null;

    #[ORM\ManyToOne(inversedBy: 'userHoraires')]
    private ?User $userHoraires = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJours(): ?string
    {
        return $this->Jours;
    }

    public function setJours(string $Jours): static
    {
        $this->Jours = $Jours;

        return $this;
    }

    public function getHorairesOuverturesMatin(): ?\DateTimeInterface
    {
        return $this->horairesOuverturesMatin;
    }

    public function setHorairesOuverturesMatin(?\DateTimeInterface $horairesOuverturesMatin): static
    {
        $this->horairesOuverturesMatin = $horairesOuverturesMatin;

        return $this;
    }

    public function getHorairesFermeturesMatin(): ?\DateTimeInterface
    {
        return $this->horairesFermeturesMatin;
    }

    public function setHorairesFermeturesMatin(?\DateTimeInterface $horairesFermeturesMatin): static
    {
        $this->horairesFermeturesMatin = $horairesFermeturesMatin;

        return $this;
    }

    public function getHorairesOuverturesSoir(): ?\DateTimeInterface
    {
        return $this->horairesOuverturesSoir;
    }

    public function setHorairesOuverturesSoir(?\DateTimeInterface $horairesOuverturesSoir): static
    {
        $this->horairesOuverturesSoir = $horairesOuverturesSoir;

        return $this;
    }

    public function getHorairesFermeturesSoir(): ?\DateTimeInterface
    {
        return $this->horairesFermeturesSoir;
    }

    public function setHorairesFermeturesSoir(?\DateTimeInterface $horairesFermeturesSoir): static
    {
        $this->horairesFermeturesSoir = $horairesFermeturesSoir;

        return $this;
    }

    public function getUserHoraires(): ?User
    {
        return $this->userHoraires;
    }

    public function setUserHoraires(?User $userHoraires): static
    {
        $this->userHoraires = $userHoraires;

        return $this;
    }
}