<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reports
 *
 * @ORM\Table(name="reports", indexes={@ORM\Index(name="fk_user", columns={"id_User"})})
 * @ORM\Entity
 */
class Reports
{
    /**
     * @var int
     *
     * @ORM\Column(name="Report_Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $reportId;

    /**
     * @var string
     *
     * @ORM\Column(name="Report_Subject", type="string", length=100, nullable=false)
     */
    private $reportSubject;

    /**
     * @var string
     *
     * @ORM\Column(name="Report_Description", type="string", length=100, nullable=false)
     */
    private $reportDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="Involvment", type="string", length=30, nullable=false)
     */
    private $involvment;

    /**
     * @var string
     *
     * @ORM\Column(name="Incident_type", type="string", length=30, nullable=false)
     */
    private $incidentType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Incident_date", type="date", nullable=false)
     */
    private $incidentDate;

    /**
     * @var string
     *
     * @ORM\Column(name="Incident_Location", type="string", length=30, nullable=false)
     */
    private $incidentLocation;

    /**
     * @var User
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_User", referencedColumnName="id_User")
     * })
     */
    private $idUser;

    public function getReportId(): ?int
    {
        return $this->reportId;
    }

    public function getReportSubject(): ?string
    {
        return $this->reportSubject;
    }

    public function setReportSubject(string $reportSubject): self
    {
        $this->reportSubject = $reportSubject;

        return $this;
    }

    public function getReportDescription(): ?string
    {
        return $this->reportDescription;
    }

    public function setReportDescription(string $reportDescription): self
    {
        $this->reportDescription = $reportDescription;

        return $this;
    }

    public function getInvolvment(): ?string
    {
        return $this->involvment;
    }

    public function setInvolvment(string $involvment): self
    {
        $this->involvment = $involvment;

        return $this;
    }

    public function getIncidentType(): ?string
    {
        return $this->incidentType;
    }

    public function setIncidentType(string $incidentType): self
    {
        $this->incidentType = $incidentType;

        return $this;
    }

    public function getIncidentDate(): ?\DateTimeInterface
    {
        return $this->incidentDate;
    }

    public function setIncidentDate(\DateTimeInterface $incidentDate): self
    {
        $this->incidentDate = $incidentDate;

        return $this;
    }

    public function getIncidentLocation(): ?string
    {
        return $this->incidentLocation;
    }

    public function setIncidentLocation(string $incidentLocation): self
    {
        $this->incidentLocation = $incidentLocation;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }


}
