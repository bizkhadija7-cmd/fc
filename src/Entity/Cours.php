<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCours = null;

    #[ORM\Column(length: 255)]
    private ?string $coach = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getDateCours(): ?\DateTimeInterface
    {
        return $this->dateCours;
    }

    public function setDateCours(\DateTimeInterface $dateCours): self
    {
        $this->dateCours = $dateCours;
        return $this;
    }

    public function getCoach(): ?string
    {
        return $this->coach;
    }

    public function setCoach(string $coach): self
    {
        $this->coach = $coach;
        return $this;
    }
}