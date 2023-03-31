<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity(fields: ['title'], message: 'Cette mission existe déjà')]
#[ORM\Entity(repositoryClass: MissionRepository::class)]
class Mission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'missions')]
    #[Assert\NotBlank(message:'Veulliez sélectionner un pays')]
    private ?Pays $pays = null;

    #[ORM\ManyToMany(targetEntity: Cible::class, inversedBy: 'missions')]
    #[Assert\NotBlank(message:'Veulliez sélectionner une cible')]
    private ?Collection $cible = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'Veulliez renseigner un titre')]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'Veulliez renseigner un nom de code')]
    private ?string $codeName = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:'Veulliez renseigner une description')]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:'Veulliez renseigner une date de début')]
    private ?\DateTimeInterface $dateStart = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:'Veulliez renseigner une date de fin')]
    private ?\DateTimeInterface $dateEnd = null;

    #[ORM\ManyToOne(inversedBy: 'missions', cascade: ['persist'])]
    #[Assert\NotBlank(message:'Veulliez sélectonner un type de mission')]
    private ?TypeMission $typeMission = null;

    #[ORM\ManyToOne(inversedBy: 'missions')]
    #[Assert\NotBlank(message:'Veulliez sélectonner une sépcialité')]
    private ?Specialite $specialite = null;

    #[ORM\ManyToMany(targetEntity: Agent::class, inversedBy: 'missions')]
    #[Assert\NotBlank(message:'Veulliez sélectonner un agent')]
    private ?Collection $agent = null;

    #[ORM\ManyToMany(targetEntity: Contact::class, inversedBy: 'missions')]
    #[Assert\NotBlank(message:'Veulliez sélectonner un contact')]
    private ?Collection $contact = null;

    #[ORM\ManyToOne(inversedBy: 'missions')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Planque $planque = null;

    #[ORM\ManyToOne(inversedBy: 'missions', cascade: ['persist'])]
    #[Assert\NotBlank(message:'Veulliez sélectonner un statut')]
    private ?Statut $statut = null;

    public function __construct()
    {
        $this->cible = new ArrayCollection();
        $this->agent = new ArrayCollection();
        $this->contact = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, Cible>
     */
    public function getCible(): Collection
    {
        return $this->cible;
    }

    public function addCible(Cible $cible): self
    {
        if (!$this->cible->contains($cible)) {
            $this->cible->add($cible);
        }

        return $this;
    }

    public function removeCible(Cible $cible): self
    {
        $this->cible->removeElement($cible);

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getTypeMission(): ?TypeMission
    {
        return $this->typeMission;
    }

    public function setTypeMission(?TypeMission $typeMission): self
    {
        $this->typeMission = $typeMission;

        return $this;
    }


    public function getSpecialite(): ?Specialite
    {
        return $this->specialite;
    }

    public function setSpecialite(Specialite $specialite): self
    {
        
        $this->specialite = $specialite;
        

        return $this;
    }

    /**
     * @return Collection<int, Agent>
     */
    public function getAgent(): Collection
    {
        return $this->agent;
    }

    public function addAgent(Agent $agent): self
    {
        if (!$this->agent->contains($agent)) {
            $this->agent->add($agent);
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        $this->agent->removeElement($agent);

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContact(): Collection
    {
        return $this->contact;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contact->contains($contact)) {
            $this->contact->add($contact);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        $this->contact->removeElement($contact);

        return $this;
    }

    public function getPlanque(): ?Planque
    {
        return $this->planque;
    }

    public function setPlanque(?Planque $planque): self
    {
        $this->planque = $planque;

        return $this;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): self
    {
        $this->statut = $statut;

        return $this;
    }
}
