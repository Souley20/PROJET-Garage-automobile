<?php

namespace App\Entity;

use App\Repository\VoituresOccasionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoituresOccasionsRepository::class)]
class VoituresOccasions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $annee = null;

    #[ORM\Column]
    private ?int $kilometrage = null;

    #[ORM\Column(length: 50)]
    private ?string $carburant = null;

    #[ORM\Column(length: 50)]
    private ?string $boiteDeVitesse = null;

    #[ORM\OneToOne(mappedBy: 'annoncesVoituresOccasions', cascade: ['persist', 'remove'])]
    private ?Annonces $annonces = null;

    #[ORM\OneToMany(mappedBy: 'voituresOccasions', targetEntity: Images::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $voituresOcassionsImages;

    #[ORM\ManyToOne(inversedBy: 'voituresOccasions')]
    private ?Marques $voituresOcassionsMarques = null;

    public function __construct()
    {
        $this->voituresOcassionsImages = new ArrayCollection();
        $this->voituresOcassionsMarques = null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(\DateTimeInterface $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): static
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): static
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getBoiteDeVitesse(): ?string
    {
        return $this->boiteDeVitesse;
    }

    public function setBoiteDeVitesse(string $boiteDeVitesse): static
    {
        $this->boiteDeVitesse = $boiteDeVitesse;

        return $this;
    }

    public function getAnnonces(): ?Annonces
    {
        return $this->annonces;
    }

    public function setAnnonces(Annonces $annonces): static
    {
        // set the owning side of the relation if necessary
        if ($annonces->getAnnoncesVoituresOccasions() !== $this) {
            $annonces->setAnnoncesVoituresOccasions($this);
        }

        $this->annonces = $annonces;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getVoituresOcassionsImages(): Collection
    {
        return $this->voituresOcassionsImages;
    }

    public function addVoituresOcassionsImage(Images $voituresOcassionsImage): static
    {
        if (!$this->voituresOcassionsImages->contains($voituresOcassionsImage)) {
            $this->voituresOcassionsImages->add($voituresOcassionsImage);
            $voituresOcassionsImage->setVoituresOccasions($this);
        }

        return $this;
    }

    public function removeVoituresOcassionsImage(Images $voituresOcassionsImage): static
    {
        if ($this->voituresOcassionsImages->removeElement($voituresOcassionsImage)) {
            // set the owning side to null (unless already changed)
            if ($voituresOcassionsImage->getVoituresOccasions() === $this) {
                $voituresOcassionsImage->setVoituresOccasions(null);
            }
        }

        return $this;
    }

    public function getVoituresOcassionsMarques(): ?Marques
    {
        return $this->voituresOcassionsMarques;
    }

    public function setVoituresOcassionsMarques(?Marques $voituresOcassionsMarques): static
    {
        $this->voituresOcassionsMarques = $voituresOcassionsMarques;

        return $this;
    }
}