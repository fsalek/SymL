<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DriverRepository")
 */
class Driver
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone_number;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rental", mappedBy="driver")
     */
    private $vehicule;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rental", mappedBy="driver", orphanRemoval=true)
     */
    private $rentals;

    public function __construct()
    {
        $this->vehicule = new ArrayCollection();
        $this->rentals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    /**
     * @return Collection|Rental[]
     */
    public function getVehicule(): Collection
    {
        return $this->vehicule;
    }

    public function addVehicule(Rental $vehicule): self
    {
        if (!$this->vehicule->contains($vehicule)) {
            $this->vehicule[] = $vehicule;
            $vehicule->setDriver($this);
        }

        return $this;
    }

    public function removeVehicule(Rental $vehicule): self
    {
        if ($this->vehicule->contains($vehicule)) {
            $this->vehicule->removeElement($vehicule);
            // set the owning side to null (unless already changed)
            if ($vehicule->getDriver() === $this) {
                $vehicule->setDriver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rental[]
     */
    public function getRentals(): Collection
    {
        return $this->rentals;
    }

    public function addRental(Rental $rental): self
    {
        if (!$this->rentals->contains($rental)) {
            $this->rentals[] = $rental;
            $rental->setDriver($this);
        }

        return $this;
    }

    public function removeRental(Rental $rental): self
    {
        if ($this->rentals->contains($rental)) {
            $this->rentals->removeElement($rental);
            // set the owning side to null (unless already changed)
            if ($rental->getDriver() === $this) {
                $rental->setDriver(null);
            }
        }

        return $this;
    }
}
