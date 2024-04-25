<?php

namespace App\Entity;

use App\Repository\AnnoncesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnoncesRepository::class)]
class Annonces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $titre = null;

    #[ORM\Column(length: 8)]
    private ?string $dateDePublication = null;

    #[ORM\OneToOne(inversedBy: 'annonces', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?VoituresOccasions $annoncesVoituresOccasions = null;

    #[ORM\ManyToOne(inversedBy: 'userAnnonces')]
    private ?User $userAnnonces = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateDePublication(): ?string
    {
        return $this->dateDePublication;
    }

    public function setDateDePublication(string $dateDePublication): static
    {
        $this->dateDePublication = $dateDePublication;

        return $this;
    }

    public function getAnnoncesVoituresOccasions(): ?VoituresOccasions
    {
        return $this->annoncesVoituresOccasions;
    }

    public function setAnnoncesVoituresOccasions(VoituresOccasions $annoncesVoituresOccasions): static
    {
        $this->annoncesVoituresOccasions = $annoncesVoituresOccasions;

        return $this;
    }

    public function getUsersAnnonces(): ?User
    {
        return $this->userAnnonces;
    }

    public function setUserAnnonces(?Users $userAnnonces): static
    {
        $this->userAnnonces = $userAnnonces;

        return $this;
    }
}