<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
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
    private Collection $userAvis;

    #[ORM\OneToMany(mappedBy: 'userServices', targetEntity: Services::class)]
    private Collection $userServices;

    #[ORM\OneToMany(mappedBy: 'UserFormulaire', targetEntity: FormulaireDeRenseignement::class)]
    private Collection $UserFormulaire;

    #[ORM\OneToMany(mappedBy: 'userRoles', targetEntity: Roles::class)]
    private Collection $userRoles;

    #[ORM\OneToMany(mappedBy: 'userHoraires', targetEntity: Horaires::class)]
    private Collection $userHoraires;

    #[ORM\OneToMany(mappedBy: 'userAnnonces', targetEntity: Annonces::class)]
    private Collection $userAnnonces;

    public function __construct()
    {
        $this->userAvis = new ArrayCollection();
        $this->userServices = new ArrayCollection();
        $this->UserFormulaire = new ArrayCollection();
        $this->userRoles = new ArrayCollection();
        $this->userHoraires = new ArrayCollection();
        $this->userAnnonces = new ArrayCollection();
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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsersIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

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
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getUserAvis(): Collection
    {
        return $this->userAvis;
    }

    public function addUserAvi(Avis $userAvi): static
    {
        if (!$this->userAvis->contains($userAvi)) {
            $this->userAvis->add($userAvi);
            $userAvi->setUserAvis($this);
        }

        return $this;
    }

    public function removeUserAvi(Avis $userAvi): static
    {
        if ($this->userAvis->removeElement($userAvi)) {
            // set the owning side to null (unless already changed)
            if ($userAvi->getUserAvis() === $this) {
                $userAvi->setUserAvis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Services>
     */
    public function getUserServices(): Collection
    {
        return $this->userServices;
    }

    public function addUserService(Services $userService): static
    {
        if (!$this->userServices->contains($userService)) {
            $this->userServices->add($userService);
            $userService->setUserServices($this);
        }

        return $this;
    }

    public function removeUserService(Services $userService): static
    {
        if ($this->userServices->removeElement($userService)) {
            // set the owning side to null (unless already changed)
            if ($userService->getUserServices() === $this) {
                $userService->setUserServices(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FormulaireDeRenseignement>
     */
    public function getUserFormulaire(): Collection
    {
        return $this->UserFormulaire;
    }

    public function addUserFormulaire(FormulaireDeRenseignement $userFormulaire): static
    {
        if (!$this->UserFormulaire->contains($userFormulaire)) {
            $this->UserFormulaire->add($userFormulaire);
            $userFormulaire->setUserFormulaire($this);
        }

        return $this;
    }

    public function removeUserFormulaire(FormulaireDeRenseignement $userFormulaire): static
    {
        if ($this->UserFormulaire->removeElement($userFormulaire)) {
            // set the owning side to null (unless already changed)
            if ($userFormulaire->getUserFormulaire() === $this) {
                $userFormulaire->setUserFormulaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Roles>
     */
    public function getUserRoles(): Collection
    {
        return $this->userRoles;
    }

    public function addUserRole(Roles $userRole): static
    {
        if (!$this->userRoles->contains($userRole)) {
            $this->userRoles->add($userRole);
            $userRole->setUserRoles($this);
        }

        return $this;
    }

    public function removeUserRole(Roles $userRole): static
    {
        if ($this->userRoles->removeElement($userRole)) {
            // set the owning side to null (unless already changed)
            if ($userRole->getUserRoles() === $this) {
                $userRole->setUserRoles(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Horaires>
     */
    public function getUserHoraires(): Collection
    {
        return $this->userHoraires;
    }

    public function addUserHoraire(Horaires $userHoraire): static
    {
        if (!$this->userHoraires->contains($userHoraire)) {
            $this->userHoraires->add($userHoraire);
            $userHoraire->setUserHoraires($this);
        }

        return $this;
    }

    public function removeUserHoraire(Horaires $userHoraire): static
    {
        if ($this->userHoraires->removeElement($userHoraire)) {
            // set the owning side to null (unless already changed)
            if ($userHoraire->getUserHoraires() === $this) {
                $userHoraire->setUserHoraires(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Annonces>
     */
    public function getUserAnnonces(): Collection
    {
        return $this->userAnnonces;
    }

    public function addUsersAnnonce(Annonces $userAnnonce): static
    {
        if (!$this->userAnnonces->contains($userAnnonce)) {
            $this->userAnnonces->add($userAnnonce);
            $userAnnonce->setUserAnnonces($this);
        }

        return $this;
    }

    public function removeUserAnnonce(Annonces $userAnnonce): static
    {
        if ($this->usersAnnonces->removeElement($usersAnnonce)) {
            // set the owning side to null (unless already changed)
            if ($userAnnonce->getUserAnnonces() === $this) {
                $userAnnonce->setUserAnnonces(null);
            }
        }

        return $this;
    }
}