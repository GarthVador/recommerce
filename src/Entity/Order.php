<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 */
class Order
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
     * @var Product[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="id")
     *
     * @Groups({"api"})
     */
    private $mobiles;

    /**
     * @var string
     * @Assert\Email()
     *
     * @ORM\Column(type="string", name="customer_email")
     *
     * @Groups({"api"})
     */
    private $customerEmail;

    /**
     * @var float
     *
     * @Groups({"api"})
     */
    private $amount;

    /**
     * @var \DateTime
     * @Groups({"api"})
     *
     */
    private $created;

    public function __construct()
    {
        $this->mobiles = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Collection|Product[]
     */
    public function getMobiles(): Collection
    {
        return $this->mobiles;
    }

    /**
     * @param Product $mobile
     * @return $this
     */
    public function addMobile(Product $mobile): self
    {
        $this->mobiles[] = $mobile;
        return $this;
    }

    /**
     * @param Collection|Product[] $mobiles
     * @return $this
     */
    public function setMobiles(Collection $mobiles): self
    {
        $this->mobiles = $mobiles;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerEmail(): string
    {
        return $this->customerEmail;
    }

    /**
     * @param string $customerEmail
     * @return $this
     */
    public function setCustomerEmail(string $customerEmail): self
    {
        $this->customerEmail = $customerEmail;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        $amount = 0;

        /** @var Product $mobile */
        foreach ($this->mobiles as $mobile) {
            $amount += $mobile->getPrice();
        }

        return $amount;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }
}