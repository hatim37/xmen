<?php

namespace App\Entity;

use App\Repository\PlanqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity(fields: ['code', 'address', 'type'], message: 'Cette planque existe déjà')]
#[ORM\Entity(repositoryClass: PlanqueRepository::class)]
class Planque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\LessThan(9999)]
    #[Assert\NotBlank(message:'Veulliez renseigner un nom')]
    private ?int $code = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'Veulliez renseigner une adresse')]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'Veulliez renseigner un type')]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'planques')]
    #[Assert\NotNull(message:'Veulliez sélectionner un pays')]
    private ?Pays $pays = null;

    #[ORM\OneToMany(mappedBy: 'planque', targetEntity: Mission::class)]
    private Collection $missions;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

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
            $mission->setPlanque($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            // set the owning side to null (unless already changed)
            if ($mission->getPlanque() === $this) {
                $mission->setPlanque(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->type;
    } 
}
