<?php

namespace App\Entity;

use App\Repository\PersontransportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersontransportRepository::class)]
class Persontransport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    public ?int $vagtrafik = null;

    #[ORM\Column]
    public ?int $bantrafik = null;

    #[ORM\Column]
    public ?int $sjofart = null;

    #[ORM\Column]
    public ?int $luftfart = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVagtrafik(): ?int
    {
        return $this->vagtrafik;
    }

    public function setVagtrafik(int $vagtrafik): static
    {
        $this->vagtrafik = $vagtrafik;

        return $this;
    }

    public function getBantrafik(): ?int
    {
        return $this->bantrafik;
    }

    public function setBantrafik(int $bantrafik): static
    {
        $this->bantrafik = $bantrafik;

        return $this;
    }

    public function getSjofart(): ?int
    {
        return $this->sjofart;
    }

    public function setSjofart(int $sjofart): static
    {
        $this->sjofart = $sjofart;

        return $this;
    }

    public function getLuftfart(): ?int
    {
        return $this->luftfart;
    }

    public function setLuftfart(int $luftfart): static
    {
        $this->luftfart = $luftfart;

        return $this;
    }
}
