<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @ORM\Id
     * @ORM\Column(name="Review_id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reviewId;


    /**
     * @var string
     *@Assert\NotBlank(message=" Please enter description")
     * @ORM\Column(name="Review_txt", type="string", length=125, nullable=true)
     */
    private $reviewTxt;

    /**
     * @var User
     *@Assert\NotBlank(message=" Please login")
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_User", referencedColumnName="id_User")
     * })
     */
    private $idUser;

    /**
     * @var Evenement
     * 
     * @Assert\NotBlank(message=" Please select an event")
     * @ORM\OneToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Event_id", referencedColumnName="Event_id")
     * })
     */
    private $event;

    public function getReviewId(): ?int
    {
        return $this->reviewId;
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

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

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

 
    
   


}
