<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"api"})
     */
    private $id;

    /**
     * @var Brand
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Brand")
     *
     * @Groups({"api"})
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="name")
     *
     * @Groups({"api"})
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(type="float", name="price")
     *
     * @Groups({"api"})
     */
    private $price;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Brand
     */
    public function getBrand(): Brand
    {
        return $this->brand;
    }

    /**
     * @param Brand $brand
     * @return $this
     */
    public function setBrand(Brand $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return $this
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

}