<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Produit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="Name_prod", type="string", length=30, nullable=false)
     */
    private $nameProd;

    /**
     * @var string
     *
     * @ORM\Column(name="Prod_Description", type="string", length=2000, nullable=false)
     */
    private $prodDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_prod", type="string", length=30, nullable=false)
     */
    private $typeProd;

    /**
     * @var float
     *
     * @ORM\Column(name="Price_prod", type="float", precision=10, scale=0, nullable=false)
     */
    private $priceProd;

    /**
     * @var int
     *
     * @ORM\Column(name="quantité", type="integer", nullable=false)
     */
    private $quantité;

    /**
     * @var string
     *
     * @ORM\Column(name="image_prod", type="string", length=100, nullable=false)
     */
    private $imageProd;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=10, nullable=false, options={"default"="'Available'"})
     */
    private $status = '\'Available\'';

    public function getIdProduit(): ?int
    {
        return $this->idProduit;
    }

    public function getNameProd(): ?string
    {
        return $this->nameProd;
    }

    public function setNameProd(string $nameProd): self
    {
        $this->nameProd = $nameProd;

        return $this;
    }

    public function getProdDescription(): ?string
    {
        return $this->prodDescription;
    }

    public function setProdDescription(string $prodDescription): self
    {
        $this->prodDescription = $prodDescription;

        return $this;
    }

    public function getTypeProd(): ?string
    {
        return $this->typeProd;
    }

    public function setTypeProd(string $typeProd): self
    {
        $this->typeProd = $typeProd;

        return $this;
    }

    public function getPriceProd(): ?float
    {
        return $this->priceProd;
    }

    public function setPriceProd(float $priceProd): self
    {
        $this->priceProd = $priceProd;

        return $this;
    }

    public function getQuantité(): ?int
    {
        return $this->quantité;
    }

    public function setQuantité(int $quantité): self
    {
        $this->quantité = $quantité;

        return $this;
    }

    public function getImageProd(): ?string
    {
        return $this->imageProd;
    }

    public function setImageProd(string $imageProd): self
    {
        $this->imageProd = $imageProd;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }


}
