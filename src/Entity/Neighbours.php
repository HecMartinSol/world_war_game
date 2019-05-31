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
     * @ORM\Column(type="integer")
     */
    private $id_country_1;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_country_2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCountry1(): ?int
    {
        return $this->id_country_1;
    }

    public function setIdCountry1(int $id_country_1): self
    {
        $this->id_country_1 = $id_country_1;

        return $this;
    }

    public function getIdCountry2(): ?int
    {
        return $this->id_country_2;
    }

    public function setIdCountry2(int $id_country_2): self
    {
        $this->id_country_2 = $id_country_2;

        return $this;
    }
}
