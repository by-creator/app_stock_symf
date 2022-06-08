<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SortieRepository::class)]
class Sortie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $dateS;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    private $qteS;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'sorties')]
    #[ORM\JoinColumn(nullable: false)]
    private $produit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateS(): ?\DateTimeInterface
    {
        return $this->dateS;
    }

    public function setDateS(\DateTimeInterface $dateS): self
    {
        $this->dateS = $dateS;

        return $this;
    }

    public function getQteS(): ?string
    {
        return $this->qteS;
    }

    public function setQteS(string $qteS): self
    {
        $this->qteS = $qteS;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
