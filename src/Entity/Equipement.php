<?php

namespace App\Entity;

use App\Repository\EquipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipementRepository::class)]
class Equipement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'equipement', targetEntity: Intervation::class)]
    private $intervation;

    #[ORM\OneToMany(mappedBy: 'equipement', targetEntity: Entretien::class)]
    private $entretiens;

    #[ORM\ManyToOne(targetEntity: Ligne::class, inversedBy: 'equipements')]
    private $ligne;

    #[ORM\OneToMany(mappedBy: 'equipement', targetEntity: Panne::class)]
    private $pannes;

    public function __construct()
    {
        $this->intervation = new ArrayCollection();
        $this->entretiens = new ArrayCollection();
        $this->pannes = new ArrayCollection();

    }

    public function __toString(){
        return $this->name.'/'.$this->getLigne();
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

    /**
     * @return Collection|Intervation[]
     */
    public function getIntervation(): Collection
    {
        return $this->intervation;
    }

    public function addIntervation(Intervation $intervation): self
    {
        if (!$this->intervation->contains($intervation)) {
            $this->intervation[] = $intervation;
            $intervation->setEquipement($this);
        }

        return $this;
    }

    public function removeIntervation(Intervation $intervation): self
    {
        if ($this->intervation->removeElement($intervation)) {
            // set the owning side to null (unless already changed)
            if ($intervation->getEquipement() === $this) {
                $intervation->setEquipement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Entretien[]
     */
    public function getEntretiens(): Collection
    {
        return $this->entretiens;
    }

    public function addEntretien(Entretien $entretien): self
    {
        if (!$this->entretiens->contains($entretien)) {
            $this->entretiens[] = $entretien;
            $entretien->setEquipement($this);
        }

        return $this;
    }

    public function removeEntretien(Entretien $entretien): self
    {
        if ($this->entretiens->removeElement($entretien)) {
            // set the owning side to null (unless already changed)
            if ($entretien->getEquipement() === $this) {
                $entretien->setEquipement(null);
            }
        }

        return $this;
    }

    public function getLigne(): ?Ligne
    {
        return $this->ligne;
    }

    public function setLigne(?Ligne $ligne): self
    {
        $this->ligne = $ligne;

        return $this;
    }

    /**
     * @return Collection|Panne[]
     */
    public function getPannes(): Collection
    {
        return $this->pannes;
    }

    public function addPanne(Panne $panne): self
    {
        if (!$this->pannes->contains($panne)) {
            $this->pannes[] = $panne;
            $panne->setEquipement($this);
        }

        return $this;
    }

    public function removePanne(Panne $panne): self
    {
        if ($this->pannes->removeElement($panne)) {
            // set the owning side to null (unless already changed)
            if ($panne->getEquipement() === $this) {
                $panne->setEquipement(null);
            }
        }

        return $this;
    }
}
