<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
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

    #[ORM\Column(type: 'datetime')]
    #[Groups(['sanctuary_read'])]
    private ?\DateTimeInterface $dateFondation = null;

    #[ORM\Column]
    #[Groups(['sanctuary_read'])]
    private ?int $entryPrice = null;

    #[ORM\Column(length: 255)]
    #[Groups(['sanctuary_read'])]
    private ?string $latitude = null;

    #[ORM\Column(length: 255)]
    #[Groups(['sanctuary_read'])]
    private ?string $longitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['sanctuary_read'])]
    private ?string $emailContact = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['sanctuary_read'])]
    private ?string $photo = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
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

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function getDateFondation(): ?\DateTimeInterface
    {
        return $this->dateFondation;
    } 
    public function setDateFondation(\DateTimeInterface $dateFondation): self
    {
        $this->dateFondation = $dateFondation;

        return $this;
    }
    public function getEntryPrice(): ?int
    {
        return $this->entryPrice;
    }
    public function setEntryPrice(int $entryPrice): self
    {
        $this->entryPrice = $entryPrice;

        return $this;
    }
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }
    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }
    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }
    public function getEmailContact(): ?string
    {
        return $this->emailContact;
    }
    public function setEmailContact(?string $emailContact): self
    {
        $this->emailContact = $emailContact;

        return $this;
    }
    public function getPhoto(): ?string
    {
        return $this->photo;
    }
    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
    public function getCreator(): ?User
    {
        return $this->creator;
    }
    public function setCreator(?User $creator): self
    {
        $this->creator = $creator;

        return $this;
    }
}