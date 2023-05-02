<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Planningcircuit
 *
 * @ORM\Table(name="planningcircuit")
 * @ORM\Entity
 */
class Planningcircuit
{
    /**
     * @var int
     *
     * @ORM\Column(name="nc", type="integer", nullable=false)
     */
    private $nc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $datedebut;

    /**
     * @var int
     *
     * @ORM\Column(name="capacite", type="integer", nullable=false)
     */
    private $capacite;

    public function getNc(): ?int
    {
        return $this->nc;
    }

    public function setNc(int $nc): self
    {
        $this->nc = $nc;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): self
    {
        $this->capacite = $capacite;

        return $this;
    }


}
