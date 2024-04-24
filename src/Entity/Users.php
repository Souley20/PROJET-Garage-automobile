<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Users\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\Users\UsersInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Users implements UsersInterface, PasswordAuthenticatedUsersInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'userAvis', targetEntity: Avis::class)]
    private Collection $usersAvis;

    #[ORM\OneToMany(mappedBy: 'usersServices', targetEntity: Services::class)]
    private Collection $usersServices;

    #[ORM\OneToMany(mappedBy: 'UsersFormulaire', targetEntity: FormulaireDeRenseignement::class)]
    private Collection $UsersFormulaire;

    #[ORM\OneToMany(mappedBy: 'usersRoles', targetEntity: Roles::class)]
    private Collection $usersRoles;

    #[ORM\OneToMany(mappedBy: 'usersHoraires', targetEntity: Horaires::class)]
    private Collection $usersHoraires;

    #[ORM\OneToMany(mappedBy: 'usersAnnonces', targetEntity: Annonces::class)]
    private Collection $usersAnnonces;

    public function __construct()
    {
        $this->usersAvis = new ArrayCollection();
        $this->usersServices = new ArrayCollection();
        $this->UsersFormulaire = new ArrayCollection();
        $this->usersRoles = new ArrayCollection();
        $this->usersHoraires = new ArrayCollection();
        $this->usersAnnonces = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this users.
     *
     * @see UsersInterface
     */
    public function getUsersIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UsersInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every users at least has ROLE_USERS
        $roles[] = 'ROLE_USERS';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
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

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the users, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getUsersAvis(): Collection
    {
        return $this->usersAvis;
    }

    public function addUsersAvi(Avis $usersAvi): static
    {
        if (!$this->usersAvis->contains($usersAvi)) {
            $this->usersAvis->add($usersAvi);
            $usersAvi->setUsersAvis($this);
        }

        return $this;
    }

    public function removeUserAvi(Avis $usersAvi): static
    {
        if ($this->usersAvis->removeElement($usersAvi)) {
            // set the owning side to null (unless already changed)
            if ($usersAvi->getUsersAvis() === $this) {
                $usersAvi->setUsersAvis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Services>
     */
    public function getUsersServices(): Collection
    {
        return $this->usersServices;
    }

    public function addUsersService(Services $usersService): static
    {
        if (!$this->usersServices->contains($usersService)) {
            $this->usersServices->add($usersService);
            $usersService->setUsersServices($this);
        }

        return $this;
    }

    public function removeUsersService(Services $usersService): static
    {
        if ($this->usersServices->removeElement($usersService)) {
            // set the owning side to null (unless already changed)
            if ($usersService->getUsersServices() === $this) {
                $usersService->setUsersServices(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FormulaireDeRenseignement>
     */
    public function getUsersFormulaire(): Collection
    {
        return $this->UsersFormulaire;
    }

    public function addUsersFormulaire(FormulaireDeRenseignement $usersFormulaire): static
    {
        if (!$this->UsersFormulaire->contains($usersFormulaire)) {
            $this->UsersFormulaire->add($usersFormulaire);
            $usersFormulaire->setUsersFormulaire($this);
        }

        return $this;
    }

    public function removeUsersFormulaire(FormulaireDeRenseignement $usersFormulaire): static
    {
        if ($this->UsersFormulaire->removeElement($usersFormulaire)) {
            // set the owning side to null (unless already changed)
            if ($usersFormulaire->getUserFormulaire() === $this) {
                $usersFormulaire->setUsersFormulaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Roles>
     */
    public function getUsersRoles(): Collection
    {
        return $this->usersRoles;
    }

    public function addUsersRole(Roles $usersRole): static
    {
        if (!$this->usersRoles->contains($usersRole)) {
            $this->usersRoles->add($usersRole);
            $usersRole->setUsersRoles($this);
        }

        return $this;
    }

    public function removeUsersRole(Roles $usersRole): static
    {
        if ($this->usersRoles->removeElement($usersRole)) {
            // set the owning side to null (unless already changed)
            if ($usersRole->getUsersRoles() === $this) {
                $usersRole->setUsersRoles(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Horaires>
     */
    public function getUsersHoraires(): Collection
    {
        return $this->usersHoraires;
    }

    public function addUsersHoraire(Horaires $usersHoraire): static
    {
        if (!$this->usersHoraires->contains($usersHoraire)) {
            $this->usersHoraires->add($usersHoraire);
            $usersHoraire->setUsersHoraires($this);
        }

        return $this;
    }

    public function removeUsersHoraire(Horaires $usersHoraire): static
    {
        if ($this->usersHoraires->removeElement($usersHoraire)) {
            // set the owning side to null (unless already changed)
            if ($usersHoraire->getUsersHoraires() === $this) {
                $usersHoraire->setUsersHoraires(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Annonces>
     */
    public function getUsersAnnonces(): Collection
    {
        return $this->usersAnnonces;
    }

    public function addUsersAnnonce(Annonces $usersAnnonce): static
    {
        if (!$this->usersAnnonces->contains($usersAnnonce)) {
            $this->usersAnnonces->add($usersAnnonce);
            $usersAnnonce->setUsersAnnonces($this);
        }

        return $this;
    }

    public function removeUserAnnonce(Annonces $usersAnnonce): static
    {
        if ($this->usersAnnonces->removeElement($usersAnnonce)) {
            // set the owning side to null (unless already changed)
            if ($usersAnnonce->getUsersAnnonces() === $this) {
                $usersAnnonce->setUsersAnnonces(null);
            }
        }

        return $this;
    }
}