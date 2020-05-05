<?php

/*
 * This file is part of aakb/kunstdatabasen.
 * (c) 2020 ITK Development
 * This source file is subject to the MIT license.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtworkRepository")
 */
class Artwork
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $artist;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $artSerial;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $purchasePrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $productionYear;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $assessmentDate;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $assessmentPrice;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getArtist(): ?string
    {
        return $this->artist;
    }

    /**
     * @param string $artist
     *
     * @return $this
     */
    public function setArtist(string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getArtSerial(): ?string
    {
        return $this->artSerial;
    }

    /**
     * @param string $artSerial
     *
     * @return $this
     */
    public function setArtSerial(string $artSerial): self
    {
        $this->artSerial = $artSerial;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPurchasePrice(): ?float
    {
        return $this->purchasePrice;
    }

    /**
     * @param float|null $purchasePrice
     *
     * @return $this
     */
    public function setPurchasePrice(?float $purchasePrice): self
    {
        $this->purchasePrice = $purchasePrice;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getProductionYear(): ?int
    {
        return $this->productionYear;
    }

    /**
     * @param int|null $productionYear
     *
     * @return $this
     */
    public function setProductionYear(?int $productionYear): self
    {
        $this->productionYear = $productionYear;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getAssessmentDate(): ?\DateTimeInterface
    {
        return $this->assessmentDate;
    }

    /**
     * @param \DateTimeInterface|null $assessmentDate
     *
     * @return $this
     */
    public function setAssessmentDate(?\DateTimeInterface $assessmentDate): self
    {
        $this->assessmentDate = $assessmentDate;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getAssessmentPrice(): ?float
    {
        return $this->assessmentPrice;
    }

    /**
     * @param float|null $assessmentPrice
     *
     * @return $this
     */
    public function setAssessmentPrice(?float $assessmentPrice): self
    {
        $this->assessmentPrice = $assessmentPrice;

        return $this;
    }
}
