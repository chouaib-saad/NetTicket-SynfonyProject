<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $numeroTicket = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date = null;

    #[ORM\Column]
    private ?float $montantTotal = null;

    #[ORM\ManyToOne(inversedBy: 'ticket')]
    private ?Caissier $caissier = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\ManyToMany(targetEntity: Produit::class, mappedBy: 'ticket')]
    private Collection $produits;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'tickets')]
    private Collection $produit;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroTicket(): ?string
    {
        return $this->numeroTicket;
    }

    public function setNumeroTicket(string $numeroTicket): static
    {
        $this->numeroTicket = $numeroTicket;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getMontantTotal(): ?float
    {
        return $this->montantTotal;
    }

    public function setMontantTotal(float $montantTotal): static
    {
        $this->montantTotal = $montantTotal;

        return $this;
    }

    public function getCaissier(): ?Caissier
    {
        return $this->caissier;
    }

    public function setCaissier(?Caissier $caissier): static
    {
        $this->caissier = $caissier;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->addTicket($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            $produit->removeTicket($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function __toString(): string
    {
        return 'Ticket #' . $this->getNumeroTicket() . ' - ' . $this->getMontantTotal() . '€';
    }
}
