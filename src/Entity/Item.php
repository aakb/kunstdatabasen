<?php

/*
 * This file is part of aakb/kunstdatabasen.
 * (c) 2020 ITK Development
 * This source file is subject to the MIT license.
 */

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 */
class Item
{
    public $itemType = 'item';

    use BlameableEntity;
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="item", cascade={"persist"})
     */
    private $images;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $organization;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $building;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $room;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $publiclyAccessible;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $geo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $department;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $purchasePrice;

    /**
     * Artwork constructor.
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
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
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @param \App\Entity\Image $image
     *
     * @return $this
     */
    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setItem($this);
        }

        return $this;
    }

    /**
     * @param \App\Entity\Image $image
     *
     * @return $this
     */
    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getItem() === $this) {
                $image->setItem(null);
            }
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     *
     * @return $this
     */
    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     *
     * @return $this
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrganization(): ?string
    {
        return $this->organization;
    }

    /**
     * @param string|null $organization
     *
     * @return $this
     */
    public function setOrganization(?string $organization): self
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string|null $location
     *
     * @return $this
     */
    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBuilding(): ?string
    {
        return $this->building;
    }

    /**
     * @param string|null $building
     *
     * @return $this
     */
    public function setBuilding(?string $building): self
    {
        $this->building = $building;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRoom(): ?string
    {
        return $this->room;
    }

    /**
     * @param string|null $room
     *
     * @return $this
     */
    public function setRoom(?string $room): self
    {
        $this->room = $room;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     *
     * @return $this
     */
    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    /**
     * @param int|null $postalCode
     *
     * @return $this
     */
    public function setPostalCode(?int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     *
     * @return $this
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getPubliclyAccessible(): ?bool
    {
        return $this->publiclyAccessible;
    }

    /**
     * @param bool|null $publiclyAccessible
     *
     * @return $this
     */
    public function setPubliclyAccessible(?bool $publiclyAccessible): self
    {
        $this->publiclyAccessible = $publiclyAccessible;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getGeo(): ?string
    {
        return $this->geo;
    }

    /**
     * @param string|null $geo
     *
     * @return $this
     */
    public function setGeo(?string $geo): self
    {
        $this->geo = $geo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string|null $comment
     *
     * @return $this
     */
    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getItemType(): string
    {
        return $this->itemType;
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
}
