<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Productreview
 *
 * @ORM\Table(name="productreview", indexes={@ORM\Index(name="fk_product_rev", columns={"id_Product"})})
 * @ORM\Entity
 */
class Productreview
{
    /**
     * @var int
     *
     * @ORM\Column(name="Review_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $reviewId;

    /**
     * @var string
     *
     * @ORM\Column(name="Product_Name", type="string", length=30, nullable=false)
     */
    private $productName;

    /**
     * @var int
     *
     * @ORM\Column(name="Rating", type="integer", nullable=false)
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="Review_txt", type="string", length=100, nullable=false)
     */
    private $reviewTxt;

    /**
     * @var \Produit
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Product", referencedColumnName="id_Produit")
     * })
     */
    private $idProduct;

    public function getReviewId(): ?int
    {
        return $this->reviewId;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

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

    public function getIdProduct(): ?Produit
    {
        return $this->idProduct;
    }

    public function setIdProduct(?Produit $idProduct): self
    {
        $this->idProduct = $idProduct;

        return $this;
    }


}
