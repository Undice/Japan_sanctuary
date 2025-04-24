<?php

namespace App\Entity;

use App\Repository\SanctuaryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SanctuaryRepository::class)]
class Sanctuary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['sanctuary_read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['sanctuary_read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['sanctuary_read'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['sanctuary_read'])]
    private ?\DateTimeInterface $date_fondation = null;

    #[ORM\Column]
    #[Groups(['sanctuary_read'])]
    private ?int $entry_price = null;

    #[ORM\Column(length: 255)]
    #[Groups(['sanctuary_read'])]
    private ?string $latitude = null;

    #[ORM\Column(length: 255)]
    #[Groups(['sanctuary_read'])]
    private ?string $longitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['sanctuary_read'])]
    private ?string $email_contact = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['sanctuary_read'])]
    private ?string $photo = null;

    // Relation OneToMany simplifiée : seulement l'ID du User
    #[ORM\ManyToOne(inversedBy: 'sanctuaries')]
    #[ORM\JoinColumn(name: 'creator_id', referencedColumnName: 'id', nullable: false)]
    #[Groups(['sanctuary_read'])]
    private ?User $creator = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getDateFondation(): ?\DateTimeInterface
    {
        return $this->date_fondation;
    }

    public function setDateFondation(\DateTimeInterface $date_fondation): static
    {
        $this->date_fondation = $date_fondation;
        return $this;
    }

    public function getEntryPrice(): ?int
    {
        return $this->entry_price;
    }

    public function setEntryPrice(int $entry_price): static
    {
        $this->entry_price = $entry_price;
        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): static
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): static
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getEmailContact(): ?string
    {
        return $this->email_contact;
    }

    public function setEmailContact(?string $email_contact): static
    {
        $this->email_contact = $email_contact;
        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;
        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): static
    {
        $this->creator = $creator;
        return $this;
    }
}
