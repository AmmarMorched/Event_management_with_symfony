<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etape
 *
 * @ORM\Table(name="etape", indexes={@ORM\Index(name="nc", columns={"nc"})})
 * @ORM\Entity
 */
class Etape
{
    /**
     * @var int
     *
     * @ORM\Column(name="rang", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $rang;

    /**
     * @var int
     *
     * @ORM\Column(name="nc", type="integer", nullable=false)
     */
    private $nc;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=30, nullable=false)
     */
    private $ville;

    /**
     * @var int
     *
     * @ORM\Column(name="jr", type="integer", nullable=false)
     */
    private $jr;

    /**
     * @var string
     *
     * @ORM\Column(name="programme", type="string", length=2000, nullable=false)
     */
    private $programme;

    public function getRang(): ?int
    {
        return $this->rang;
    }

    public function getNc(): ?int
    {
        return $this->nc;
    }

    public function setNc(int $nc): self
    {
        $this->nc = $nc;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getJr(): ?int
    {
        return $this->jr;
    }

    public function setJr(int $jr): self
    {
        $this->jr = $jr;

        return $this;
    }

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme(string $programme): self
    {
        $this->programme = $programme;

        return $this;
    }


}
