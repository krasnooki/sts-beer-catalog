<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
	
/**
 * @ORM\Entity(repositoryClass="App\Repository\BrewerEntityRepository")
 */
class BrewerEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BeerEntity", mappedBy="brewer")
     */
    private $beerEntities;

    public function __construct()
    {
        $this->beerEntities = new ArrayCollection();
    }

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

    /**
     * @return Collection|BeerEntity[]
     */
    public function getBeerEntities(): Collection
    {
        return $this->beerEntities;
    }

    public function addBeerEntity(BeerEntity $beerEntity): self
    {
        if (!$this->beerEntities->contains($beerEntity)) {
            $this->beerEntities[] = $beerEntity;
            $beerEntity->setBrewery($this);
        }

        return $this;
    }

    public function removeBeerEntity(BeerEntity $beerEntity): self
    {
        if ($this->beerEntities->contains($beerEntity)) {
            $this->beerEntities->removeElement($beerEntity);
            // set the owning side to null (unless already changed)
            if ($beerEntity->getBrewer() === $this) {
                $beerEntity->setBrewer(null);
            }
        }

        return $this;
    }
}
