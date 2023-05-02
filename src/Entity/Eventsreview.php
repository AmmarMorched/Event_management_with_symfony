<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eventsreview
 *
 * @ORM\Table(name="eventsreview", indexes={@ORM\Index(name="fk_User_event_eventsrev", columns={"id_User"}), @ORM\Index(name="fk_event_eventsrev", columns={"Event_id"})})
 * @ORM\Entity
 */
class Eventsreview
{
    /**
     * @var int
     *
     * @ORM\Column(name="Review_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reviewId;

    /**
     * @var string
     *
     * @ORM\Column(name="Event_name", type="string", length=30, nullable=false)
     */
    private $eventName;

    /**
     * @var string
     *
     * @ORM\Column(name="Review_txt", type="string", length=125, nullable=false)
     */
    private $reviewTxt;

    /**
     * @var Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Event_id", referencedColumnName="Event_id")
     * })
     */
    private $event;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_User", referencedColumnName="id_User")
     * })
     */
    private $idUser;

    public function getReviewId(): ?int
    {
        return $this->reviewId;
    }

    public function getEventName(): ?string
    {
        return $this->eventName;
    }

    public function setEventName(string $eventName): self
    {
        $this->eventName = $eventName;

        return $this;
    }

    public function getReviewTxt(): ?string
    {
        return $this->reviewTxt;
    }

    public function setReviewTxt(string $reviewTxt): self
    {
        $this->reviewTxt = $reviewTxt;

        return $this;
    }

    public function getEvent(): ?Evenement
    {
        return $this->event;
    }

    public function setEvent(?Evenement $event): self
    {
        $this->event = $event;

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
