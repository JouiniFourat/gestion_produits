<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('client')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $full_name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: PointVente::class)]
    private Collection $pointVentes;

    public function __construct()
    {
        $this->pointVentes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name): self
    {
        $this->full_name = $full_name;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    /**
     * @return Collection<int, PointVente>
     */
    public function getPointVentes(): Collection
    {
        return $this->pointVentes;
    }

    public function addPointVente(PointVente $pointVente): self
    {
        if (!$this->pointVentes->contains($pointVente)) {
            $this->pointVentes->add($pointVente);
            $pointVente->setClient($this);
        }

        return $this;
    }

    public function removePointVente(PointVente $pointVente): self
    {
        if ($this->pointVentes->removeElement($pointVente)) {
            // set the owning side to null (unless already changed)
            if ($pointVente->getClient() === $this) {
                $pointVente->setClient(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->full_name;
    }
}
