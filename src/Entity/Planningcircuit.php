<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Planningcircuit
 *
 * @ORM\Table(name="planningcircuit", indexes={@ORM\Index(name="zerezrezr", columns={"nc"})})
 * @ORM\Entity
 */
class Planningcircuit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedébut", type="date", nullable=false)
     */
    private $datedébut;

    /**
     * @var int
     *
     * @ORM\Column(name="capacité", type="integer", nullable=false)
     */
    private $capacité;

    /**
     * @var \Circuit
     *
     * @ORM\ManyToOne(targetEntity="Circuit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nc", referencedColumnName="nc")
     * })
     */
    private $nc;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedébut(): ?\DateTimeInterface
    {
        return $this->datedébut;
    }

    public function setDatedébut(\DateTimeInterface $datedébut): self
    {
        $this->datedébut = $datedébut;

        return $this;
    }

    public function getCapacité(): ?int
    {
        return $this->capacité;
    }

    public function setCapacité(int $capacité): self
    {
        $this->capacité = $capacité;

        return $this;
    }

    public function getNc(): ?Circuit
    {
        return $this->nc;
    }

    public function setNc(?Circuit $nc): self
    {
        $this->nc = $nc;

        return $this;
    }


}
