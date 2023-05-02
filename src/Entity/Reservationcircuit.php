<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationcircuit
 *
 * @ORM\Table(name="reservationcircuit")
 * @ORM\Entity
 */
class Reservationcircuit
{
    /**
     * @var int
     *
     * @ORM\Column(name="num_res", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numRes;

    /**
     * @var int
     *
     * @ORM\Column(name="id_client", type="integer", nullable=false)
     */
    private $idClient;

    /**
     * @var int
     *
     * @ORM\Column(name="nc", type="integer", nullable=false)
     */
    private $nc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut_circuit", type="date", nullable=false)
     */
    private $dateDebutCircuit;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_places", type="integer", nullable=false)
     */
    private $nbrPlaces;

    public function getNumRes(): ?int
    {
        return $this->numRes;
    }

    public function getIdClient(): ?int
    {
        return $this->idClient;
    }

    public function setIdClient(int $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
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

    public function getDateDebutCircuit(): ?\DateTimeInterface
    {
        return $this->dateDebutCircuit;
    }

    public function setDateDebutCircuit(\DateTimeInterface $dateDebutCircuit): self
    {
        $this->dateDebutCircuit = $dateDebutCircuit;

        return $this;
    }

    public function getNbrPlaces(): ?int
    {
        return $this->nbrPlaces;
    }

    public function setNbrPlaces(int $nbrPlaces): self
    {
        $this->nbrPlaces = $nbrPlaces;

        return $this;
    }


}
