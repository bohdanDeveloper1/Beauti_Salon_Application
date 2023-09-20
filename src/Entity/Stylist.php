<?php

namespace App\Entity;

use App\Repository\StylistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StylistRepository::class)]
class Stylist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'stylists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Service $category = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $instagram_account = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\OneToMany(mappedBy: 'stylist', targetEntity: StylistWorks::class)]
    private Collection $stylistWorks;

    public function __construct()
    {
        $this->stylistWorks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Service
    {
        return $this->category;
    }

    public function setCategory(?Service $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getInstagramAccount(): ?string
    {
        return $this->instagram_account;
    }

    public function setInstagramAccount(?string $instagram_account): static
    {
        $this->instagram_account = $instagram_account;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, StylistWorks>
     */
    public function getStylistWorks(): Collection
    {
        return $this->stylistWorks;
    }

    public function addStylistWork(StylistWorks $stylistWork): static
    {
        if (!$this->stylistWorks->contains($stylistWork)) {
            $this->stylistWorks->add($stylistWork);
            $stylistWork->setStylist($this);
        }

        return $this;
    }

    public function removeStylistWork(StylistWorks $stylistWork): static
    {
        if ($this->stylistWorks->removeElement($stylistWork)) {
            // set the owning side to null (unless already changed)
            if ($stylistWork->getStylist() === $this) {
                $stylistWork->setStylist(null);
            }
        }

        return $this;
    }
}
