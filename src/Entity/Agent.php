<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity(fields: ['name', 'firstName', 'identificationCode'], message: 'Cette Agent ou code d\'identification existe déjà')]
#[ORM\Entity(repositoryClass: AgentRepository::class)]
class Agent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'Veulliez renseigner un nom')]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'Veulliez renseigner un prénom')]
    private ?string $firstName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotNull(message:'Veulliez renseigner une date')]
    private ?\DateTimeInterface $dateOfBirth = null;

    #[ORM\Column]
    #[Assert\NotNull(message:'Veulliez renseigner un code d\'identification')]
    private ?int $identificationCode = null;

    #[ORM\ManyToOne(inversedBy: 'agents')]
    #[Assert\NotNull(message:'Veulliez sélectionner une nationalité')]
    private ?Nationalite $nationalite = null;

    #[ORM\ManyToMany(targetEntity: Specialite::class, inversedBy: 'agents')]
    #[ORM\JoinTable(name:'agent_specialite')]
    #[Assert\NotNull(message:'Veulliez sélectionner une spécialité')]
    private Collection $specialite;

    #[ORM\ManyToMany(targetEntity: Mission::class, mappedBy: 'agent')]
    private Collection $missions;

    public function __construct()
    {
        $this->specialite = new ArrayCollection();
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getIdentificationCode(): ?int
    {
        return $this->identificationCode;
    }

    public function setIdentificationCode(int $identificationCode): self
    {
        $this->identificationCode = $identificationCode;

        return $this;
    }

    public function getNationalite(): ?Nationalite
    {
        return $this->nationalite;
    }

    public function setNationalite(?Nationalite $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * @return Collection<int, Specialite>
     */
    public function getSpecialite(): Collection
    {
        return $this->specialite;
    }

    public function addSpecialite(Specialite $specialite): self
    {
        if (!$this->specialite->contains($specialite)) {
            $this->specialite->add($specialite);
        }

        return $this;
    }

    public function removeSpecialite(Specialite $specialite): self
    {
        $this->specialite->removeElement($specialite);

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Mission>
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions->add($mission);
            $mission->addAgent($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            $mission->removeAgent($this);
        }

        return $this;
    }
}
