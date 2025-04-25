<?php

namespace App\Entity;

use App\Repository\CaissierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CaissierRepository::class)]
class Caissier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $numeroCaisse = null;

    /**
     * @var Collection<int, Ticket>
     */
    #[ORM\OneToMany(mappedBy: 'caissier', targetEntity: Ticket::class, cascade: ['remove'])]
    private Collection $ticket;

    public function __construct()
    {
        $this->ticket = new ArrayCollection();
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

    public function getNumeroCaisse(): ?int
    {
        return $this->numeroCaisse;
    }

    public function setNumeroCaisse(int $numeroCaisse): static
    {
        $this->numeroCaisse = $numeroCaisse;

        return $this;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getTicket(): Collection
    {
        return $this->ticket;
    }

    public function addTicket(Ticket $ticket): static
    {
        if (!$this->ticket->contains($ticket)) {
            $this->ticket->add($ticket);
            $ticket->setCaissier($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): static
    {
        if ($this->ticket->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getCaissier() === $this) {
                $ticket->setCaissier(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNom() . ' (Caisse ' . $this->getNumeroCaisse() . ')';
    }
}
