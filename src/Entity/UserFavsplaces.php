<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserFavsplaces
 *
 * @ORM\Table(name="user_favsplaces", indexes={@ORM\Index(name="favplace_idplace", columns={"id_Place"}), @ORM\Index(name="favuser_idUser", columns={"id_User"})})
 * @ORM\Entity
 */
class UserFavsplaces
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Favs", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idFavs;

    /**
     * @var \User
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_User", referencedColumnName="id_User")
     * })
     */
    private $idUser;

    /**
     * @var \Placetovisit
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Placetovisit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Place", referencedColumnName="Place_Id")
     * })
     */
    private $idPlace;

    public function getIdFavs(): ?int
    {
        return $this->idFavs;
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

    public function getIdPlace(): ?Placetovisit
    {
        return $this->idPlace;
    }

    public function setIdPlace(?Placetovisit $idPlace): self
    {
        $this->idPlace = $idPlace;

        return $this;
    }


}
