<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $adresse;

    #[ORM\OneToMany(mappedBy: 'fournisseur', targetEntity: ArticleMagasin::class)]
    private $articleMagasins;

    public function __construct()
    {
        $this->articleMagasins = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->name;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|ArticleMagasin[]
     */
    public function getArticleMagasins(): Collection
    {
        return $this->articleMagasins;
    }

    public function addArticleMagasin(ArticleMagasin $articleMagasin): self
    {
        if (!$this->articleMagasins->contains($articleMagasin)) {
            $this->articleMagasins[] = $articleMagasin;
            $articleMagasin->setFournisseur($this);
        }

        return $this;
    }

    public function removeArticleMagasin(ArticleMagasin $articleMagasin): self
    {
        if ($this->articleMagasins->removeElement($articleMagasin)) {
            // set the owning side to null (unless already changed)
            if ($articleMagasin->getFournisseur() === $this) {
                $articleMagasin->setFournisseur(null);
            }
        }

        return $this;
    }
}
