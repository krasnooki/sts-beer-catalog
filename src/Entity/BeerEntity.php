<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BeerEntityRepository")
 */
class BeerEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price_per_litre;
	
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BrewerEntity", inversedBy="beerEntities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brewer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image_url;

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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    public function setCountryCode(string $country_code): self
    {
        $this->country_code = $country_code;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPricePerLitre(): ?string
    {
        return $this->price_per_litre;
    }

    public function setPricePerLitre(string $price_per_litre): self
    {
        $this->price_per_litre = $price_per_litre;

        return $this;
    }

    public function getBrewer(): ?BrewerEntity
    {
        return $this->brewer;
    }

    public function setBrewer(?BrewerEntity $brewer): self
    {
        $this->brewer = $brewer;

        return $this;
    }

    public function getBrewery(): ?int
    {
        return $this->brewery;
    }

    public function setBrewery(int $brewery): self
    {
        $this->brewery = $brewery;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(string $image_url): self
    {
        $this->image_url = $image_url;

        return $this;
    }
}
