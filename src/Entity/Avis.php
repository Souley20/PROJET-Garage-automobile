<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Regex(
        pattern: "/^[^&<>\"']*$/",
        message: "Le nom ne doit pas contenir de caractères spéciaux."
    )]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    #[Assert\Regex(
        pattern: "/^[^&<>\"']*$/",
        message: "Le prenom ne doit pas contenir de caractères spéciaux."
    )]
    private ?string $prenom = null;

    #[ORM\Column(length: 2000)]
    #[Assert\Regex(
        pattern: "/^[^&<>\"']*$/",
        message: "Le commentaire ne doit pas contenir de caractères spéciaux."
    )]
    private ?string $commentaire = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(options: ["default" => false])]
    private ?bool $valide;

    #[ORM\ManyToOne(inversedBy: 'userAvis')]
    private ?User $userAvis = null;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->valide = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function isValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(bool $valide): static
    {
        $this->valide = $valide;

        return $this;
    }

    public function getUserAvis(): ?Users
    {
        return $this->userAvis;
    }

    public function setUserAvis(?User $userAvis): static
    {
        $this->userAvis = $userAvis;

        return $this;
    }
}