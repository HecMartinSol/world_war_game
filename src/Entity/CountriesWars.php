<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountriesWarsRepository")
 */
class CountriesWars
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
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Wars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $war;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Countries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $conquerer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?Countries
    {
        return $this->country;
    }

    public function setCountry(?Countries $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getWar(): ?Wars
    {
        return $this->war;
    }

    public function setWar(?Wars $war): self
    {
        $this->war = $war;

        return $this;
    }

    public function getConquerer(): ?Countries
    {
        return $this->conquerer;
    }

    public function setConquerer(?Countries $conquerer): self
    {
        $this->conquerer = $conquerer;

        return $this;
    }
}
