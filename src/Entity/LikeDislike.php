<?php

namespace LikeDislike;

use App\Entity\Evenement;
use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Likedislike
 *
 * @ORM\Table(name="likedislike", indexes={@ORM\Index(name="mlkmlkml", columns={"Event_id"}), @ORM\Index(name="jijilkjlkjl", columns={"User_id"})})
 * @ORM\Entity
 */
class Likedislike
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
     *   @ORM\JoinColumn(name="User_id", referencedColumnName="id_User")
     * })
     */
    private $user;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?int
    {
        return $this->event;
    }

    public function setEvent(int $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getUser(): ?int
    {
        return $this->user;
    }

    public function setUser(int $user): self
    {
        $this->user = $user;

        return $this;
    }



}
