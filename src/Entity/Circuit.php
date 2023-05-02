<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Circuit
 *
 * @ORM\Table(name="circuit")
 * @ORM\Entity
 */
class Circuit
{
    /**
     * @var int
     *
     * @ORM\Column(name="nc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nc;

    /**
     * @var string
     *
     * @ORM\Column(name="vdep", type="string", length=30, nullable=false)
     */
    private $vdep;

    /**
     * @var string
     *
     * @ORM\Column(name="varr", type="string", length=30, nullable=false)
     */
    private $varr;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="duree", type="integer", nullable=false)
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=60, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2000, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="imageSrc", type="string", length=1000, nullable=false)
     */
    private $imagesrc;

    public function getNc(): ?int
    {
        return $this->nc;
    }

    public function getVdep(): ?string
    {
        return $this->vdep;
    }

    public function setVdep(string $vdep): self
    {
        $this->vdep = $vdep;

        return $this;
    }

    public function getVarr(): ?string
    {
        return $this->varr;
    }

    public function setVarr(string $varr): self
    {
        $this->varr = $varr;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImagesrc(): ?string
    {
        return $this->imagesrc;
    }

    public function setImagesrc(string $imagesrc): self
    {
        $this->imagesrc = $imagesrc;

        return $this;
    }


}
