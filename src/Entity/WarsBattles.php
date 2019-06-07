<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WarsBattlesRepository")
 */
class WarsBattles
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Wars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $war;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Countries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country_attacker;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Countries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country_defender;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Countries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country_winner;

    /**
     * @ORM\Column(type="integer")
     */
    private $points;

    /**
     * @ORM\Column(type="datetime")
     */
    private $battle_date;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCountryAttacker(): ?Countries
    {
        return $this->country_attacker;
    }

    public function setCountryAttacker(?Countries $country_attacker): self
    {
        $this->country_attacker = $country_attacker;

        return $this;
    }

    public function getCountryDefender(): ?Countries
    {
        return $this->country_defender;
    }

    public function setCountryDefender(?Countries $country_defender): self
    {
        $this->country_defender = $country_defender;

        return $this;
    }

    public function getCountryWinner(): ?Countries
    {
        return $this->country_winner;
    }

    public function setCountryWinner(?Countries $country_winner): self
    {
        $this->country_winner = $country_winner;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getBattleDate(): ?\DateTimeInterface
    {
        return $this->battle_date;
    }

    public function setBattleDate(\DateTimeInterface $battle_date): self
    {
        $this->battle_date = $battle_date;

        return $this;
    }
}
