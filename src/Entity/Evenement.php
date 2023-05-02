<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="Event_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $eventId;

    /**
     * @var string
     *
     * @ORM\Column(name="Event_name", type="string", length=30, nullable=false)
     */
    private $eventName;

    /**
     * @var string
     *
     * @ORM\Column(name="CityName", type="string", length=30, nullable=false)
     */
    private $cityname;

    /**
     * @var string
     *
     * @ORM\Column(name="Event_description", type="text", length=65535, nullable=false)
     */
    private $eventDescription;

    /**
     * @var int
     *
     * @ORM\Column(name="EventPrice", type="integer", nullable=false)
     */
    private $eventprice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Start_date", type="date", nullable=false)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="date", nullable=false)
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="EventPoster", type="string", length=120, nullable=false)
     */
    private $eventposter;

    /**
     * @var string
     *
     * @ORM\Column(name="Event_pic2", type="string", length=120, nullable=false)
     */
    private $eventPic2;

    /**
     * @var string
     *
     * @ORM\Column(name="Event_pic3", type="string", length=120, nullable=false)
     */
    private $eventPic3;

    public function getEventId(): ?int
    {
        return $this->eventId;
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

    public function getCityname(): ?string
    {
        return $this->cityname;
    }

    public function setCityname(string $cityname): self
    {
        $this->cityname = $cityname;

        return $this;
    }

    public function getEventDescription(): ?string
    {
        return $this->eventDescription;
    }

    public function setEventDescription(string $eventDescription): self
    {
        $this->eventDescription = $eventDescription;

        return $this;
    }

    public function getEventprice(): ?int
    {
        return $this->eventprice;
    }

    public function setEventprice(int $eventprice): self
    {
        $this->eventprice = $eventprice;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getEventposter(): ?string
    {
        return $this->eventposter;
    }

    public function setEventposter(string $eventposter): self
    {
        $this->eventposter = $eventposter;

        return $this;
    }

    public function getEventPic2(): ?string
    {
        return $this->eventPic2;
    }

    public function setEventPic2(string $eventPic2): self
    {
        $this->eventPic2 = $eventPic2;

        return $this;
    }

    public function getEventPic3(): ?string
    {
        return $this->eventPic3;
    }

    public function setEventPic3(string $eventPic3): self
    {
        $this->eventPic3 = $eventPic3;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getEventName();
    } 

}
