<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WarsRepository")
 */
class Wars
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $end_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_actions;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $country_winner_id;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getNumActions(): ?int
    {
        return $this->num_actions;
    }

    public function setNumActions(int $num_actions): self
    {
        $this->num_actions = $num_actions;

        return $this;
    }

    public function getCountryWinnerId(): ?int
    {
        return $this->country_winner_id;
    }

    public function setCountryWinnerId(?int $country_winner_id): self
    {
        $this->country_winner_id = $country_winner_id;

        return $this;
    }
}
