<?php

namespace App\Entity;

use App\Repository\RenewableRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RenewableRepository::class)]
class Renewable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $biobransle = null;

    #[ORM\Column(nullable: true)]
    private ?int $vattenkraft = null;

    #[ORM\Column(nullable: true)]
    private ?int $vindkraft = null;

    #[ORM\Column(nullable: true)]
    private ?int $varmepumpar = null;

    #[ORM\Column(nullable: true)]
    private ?int $solenergi = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalgron = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalenergi = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getBiobransle(): ?int
    {
        return $this->biobransle;
    }

    public function setBiobransle(?int $biobransle): static
    {
        $this->biobransle = $biobransle;

        return $this;
    }

    public function getVattenkraft(): ?int
    {
        return $this->vattenkraft;
    }

    public function setVattenkraft(?int $vattenkraft): static
    {
        $this->vattenkraft = $vattenkraft;

        return $this;
    }

    public function getVindkraft(): ?int
    {
        return $this->vindkraft;
    }

    public function setVindkraft(?int $vindkraft): static
    {
        $this->vindkraft = $vindkraft;

        return $this;
    }

    public function getVarmepumpar(): ?int
    {
        return $this->varmepumpar;
    }

    public function setVarmepumpar(?int $varmepumpar): static
    {
        $this->varmepumpar = $varmepumpar;

        return $this;
    }

    public function getSolenergi(): ?int
    {
        return $this->solenergi;
    }

    public function setSolenergi(?int $solenergi): static
    {
        $this->solenergi = $solenergi;

        return $this;
    }

    public function getTotalgron(): ?int
    {
        return $this->totalgron;
    }

    public function setTotalgron(?int $totalgron): static
    {
        $this->totalgron = $totalgron;

        return $this;
    }

    public function getTotalenergi(): ?int
    {
        return $this->totalenergi;
    }

    public function setTotalenergi(?int $totalenergi): static
    {
        $this->totalenergi = $totalenergi;

        return $this;
    }
}
