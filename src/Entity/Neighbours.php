<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NeighboursRepository")
 */
class Neighbours
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Countries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country_1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Countries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country_2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry1(): ?Countries
    {
        return $this->country_1;
    }

    public function setCountry1(?Countries $country_1): self
    {
        $this->country_1 = $country_1;

        return $this;
    }

    public function getCountry2(): ?Countries
    {
        return $this->country_2;
    }

    public function setCountry2(?Countries $country_2): self
    {
        $this->country_2 = $country_2;

        return $this;
    }
}
