<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbreSeats;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbreDoors;

    /**
     * @ORM\Column(type="float")
     */
    private $cost;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="cars")
     * @ORM\JoinColumn(nullable=true)
     */
    private $category;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getNbreSeats(): ?int
    {
        return $this->nbreSeats;
    }

    public function setNbreSeats(int $nbreSeats): self
    {
        $this->nbreSeats = $nbreSeats;

        return $this;
    }

    public function getNbreDoors(): ?int
    {
        return $this->nbreDoors;
    }

    public function setNbreDoors(int $nbreDoors): self
    {
        $this->nbreDoors = $nbreDoors;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(float $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
