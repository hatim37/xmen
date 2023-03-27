<?php

namespace App\Entity;

use App\Repository\CibleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity(fields: ['name', 'firstName'], message: 'Cette cible existe déjà')]
#[ORM\Entity(repositoryClass: CibleRepository::class)]
class Cible
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
    #[Assert\NotNull(message:'Veulliez sélectionner une dates')]
    private ?\DateTimeInterface $dateOfBirth = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'Veulliez renseigner un nom de code')]
    private ?string $codeName = null;

    #[ORM\ManyToOne(inversedBy: 'cibles')]
    #[Assert\NotNull(message:'Veulliez sélectionner une nationalité')]
    private ?Nationalite $nationalite = null;

    #[ORM\ManyToMany(targetEntity: Mission::class, mappedBy: 'cible')]
    private Collection $missions;

    public function __construct()
    {
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

    public function getCodeName(): ?string
    {
        return $this->codeName;
    }

    public function setCodeName(string $codeName): self
    {
        $this->codeName = $codeName;

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
            $mission->addCible($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            $mission->removeCible($this);
        }

        return $this;
    }
}
