<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PokemonRepository::class)
 */
class Pokemon
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $evolution;

    /**
     * @ORM\Column(type="integer")
     */
    private $dresseur_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $expe;

    private $forSale = false;
    private $price;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function setForSale($price){
        $this->price = $price;
        $this->forSale = true;

        return this;
    }

    public function getForSale(){
        return $this->forSale;
    }

    public function getPrice(){
        return $this->price;
    }
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getEvolution(): ?bool
    {
        return $this->evolution;
    }

    public function setEvolution(?bool $evolution): self
    {
        $this->evolution = $evolution;

        return $this;
    }

    public function getDresseurId(): ?int
    {
        return $this->dresseur_id;
    }

    public function setDresseurId(int $dresseur_id): self
    {
        $this->dresseur_id = $dresseur_id;

        return $this;
    }

    public function getExpe(): ?int
    {
        return $this->expe;
    }

    public function setExpe(?int $expe): self
    {
        $this->expe = $expe;

        return $this;
    }
}
