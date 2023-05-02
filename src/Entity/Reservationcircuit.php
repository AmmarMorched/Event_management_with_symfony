<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationcircuit
 *
 * @ORM\Table(name="reservationcircuit", indexes={@ORM\Index(name="sdferezr", columns={"nc"}), @ORM\Index(name="zerzerezr", columns={"id_client"})})
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_début", type="date", nullable=false)
     */
    private $dateDébut;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_place", type="integer", nullable=false)
     */
    private $nbrPlace;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_client", referencedColumnName="id_User")
     * })
     */
    private $idClient;

    /**
     * @var \Circuit
     *
     * @ORM\ManyToOne(targetEntity="Circuit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nc", referencedColumnName="nc")
     * })
     */
    private $nc;

    public function getNumRes(): ?int
    {
        return $this->numRes;
    }

    public function getDateDébut(): ?\DateTimeInterface
    {
        return $this->dateDébut;
    }

    public function setDateDébut(\DateTimeInterface $dateDébut): self
    {
        $this->dateDébut = $dateDébut;

        return $this;
    }

    public function getNbrPlace(): ?int
    {
        return $this->nbrPlace;
    }

    public function setNbrPlace(int $nbrPlace): self
    {
        $this->nbrPlace = $nbrPlace;

        return $this;
    }

    public function getIdClient(): ?User
    {
        return $this->idClient;
    }

    public function setIdClient(?User $idClient): self
    {
        $this->idClient = $idClient;

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
