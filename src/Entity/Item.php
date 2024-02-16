<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Brand $brand = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $sku = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $shortdesc = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 5, nullable: true)]
    private ?string $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $link = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $caffeineType = null;

    #[ORM\Column(nullable: true)]
    private ?int $count = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $flavored = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $seasonal = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $instock = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $facebook = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $isKCup = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): static
    {
        $this->sku = $sku;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getShortdesc(): ?string
    {
        return $this->shortdesc;
    }

    public function setShortdesc(?string $shortdesc): static
    {
        $this->shortdesc = $shortdesc;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): static
    {
        $this->link = $link;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getCaffeineType(): ?string
    {
        return $this->caffeineType;
    }

    public function setCaffeineType(?string $caffeineType): static
    {
        $this->caffeineType = $caffeineType;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(?int $count): static
    {
        $this->count = $count;

        return $this;
    }

    public function getFlavored(): ?string
    {
        return $this->flavored;
    }

    public function setFlavored(?string $flavored): static
    {
        $this->flavored = $flavored;

        return $this;
    }

    public function getSeasonal(): ?string
    {
        return $this->seasonal;
    }

    public function setSeasonal(?string $seasonal): static
    {
        $this->seasonal = $seasonal;

        return $this;
    }

    public function getInstock(): ?string
    {
        return $this->instock;
    }

    public function setInstock(?string $instock): static
    {
        $this->instock = $instock;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): static
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getIsKCup(): ?string
    {
        return $this->isKCup;
    }

    public function setIsKCup(?string $isKCup): static
    {
        $this->isKCup = $isKCup;

        return $this;
    }
}
