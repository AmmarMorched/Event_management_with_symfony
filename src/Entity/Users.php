<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="Username", columns={"Username"})})
 * @ORM\Entity
 */
class Users
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_User", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="User_FirstName", type="string", length=30, nullable=false)
     */
    private $userFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="User_lastName", type="string", length=30, nullable=false)
     */
    private $userLastname;

    /**
     * @var string
     *
     * @ORM\Column(name="User_mail", type="string", length=30, nullable=false)
     */
    private $userMail;

    /**
     * @var int
     *
     * @ORM\Column(name="User_phone", type="integer", nullable=false)
     */
    private $userPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="Username", type="string", length=30, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="Password", type="string", length=30, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=30, nullable=false)
     */
    private $role;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lang1", type="string", length=120, nullable=true, options={"default"="NULL"})
     */
    private $lang1 = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="lang2", type="string", length=100, nullable=true, options={"default"="NULL"})
     */
    private $lang2 = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="lang3", type="string", length=100, nullable=true, options={"default"="NULL"})
     */
    private $lang3 = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Cityname", type="string", length=100, nullable=true, options={"default"="NULL"})
     */
    private $cityname = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Nationality", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $nationality = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Langue", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $langue = 'NULL';

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function getUserFirstname(): ?string
    {
        return $this->userFirstname;
    }

    public function setUserFirstname(string $userFirstname): self
    {
        $this->userFirstname = $userFirstname;

        return $this;
    }

    public function getUserLastname(): ?string
    {
        return $this->userLastname;
    }

    public function setUserLastname(string $userLastname): self
    {
        $this->userLastname = $userLastname;

        return $this;
    }

    public function getUserMail(): ?string
    {
        return $this->userMail;
    }

    public function setUserMail(string $userMail): self
    {
        $this->userMail = $userMail;

        return $this;
    }

    public function getUserPhone(): ?int
    {
        return $this->userPhone;
    }

    public function setUserPhone(int $userPhone): self
    {
        $this->userPhone = $userPhone;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getLang1(): ?string
    {
        return $this->lang1;
    }

    public function setLang1(?string $lang1): self
    {
        $this->lang1 = $lang1;

        return $this;
    }

    public function getLang2(): ?string
    {
        return $this->lang2;
    }

    public function setLang2(?string $lang2): self
    {
        $this->lang2 = $lang2;

        return $this;
    }

    public function getLang3(): ?string
    {
        return $this->lang3;
    }

    public function setLang3(?string $lang3): self
    {
        $this->lang3 = $lang3;

        return $this;
    }

    public function getCityname(): ?string
    {
        return $this->cityname;
    }

    public function setCityname(?string $cityname): self
    {
        $this->cityname = $cityname;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(?string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }


}
