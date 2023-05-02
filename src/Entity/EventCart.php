<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventCart
 *
 * @ORM\Table(name="event_cart", indexes={@ORM\Index(name="mk__idbb", columns={"User_id"}), @ORM\Index(name="fk_idddv", columns={"Event_id"})})
 * @ORM\Entity
 */
class EventCart
{
    /**
     * @var int
     *
     * @ORM\Column(name="cart_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cartId;

    /**
     * @var int
     *
     * @ORM\Column(name="Total_Price", type="integer", nullable=false)
     */
    private $totalPrice;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Event_id", referencedColumnName="Event_id")
     * })
     */
    private $event;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="User_id", referencedColumnName="id_User")
     * })
     */
    private $user;

    public function getCartId(): ?int
    {
        return $this->cartId;
    }

    public function getTotalPrice(): ?int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(int $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

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

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }


}
