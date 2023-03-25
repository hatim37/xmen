<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgentRepository::class)]
class Agent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateOfBirth = null;

    #[ORM\Column]
    private ?int $identificationCode = null;

    #[ORM\ManyToOne(inversedBy: 'agents')]
    private ?Nationalite $nationalite = null;

    #[ORM\ManyToMany(targetEntity: Specialite::class, inversedBy: 'agents')]
    private Collection $specialite;

    public function __construct()
    {
        $this->specialite = new ArrayCollection();
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
}
