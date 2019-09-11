<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BrandRepository")
 */
class Brand
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_ru;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alias;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BrandMenu", mappedBy="brand")
     */
    private $brandMenus;
    
    

    public function __construct()
    {
        $this->brandMenus = new ArrayCollection();
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

    public function getNameRu(): ?string
    {
        return $this->name_ru;
    }

    public function setNameRu(?string $name_ru): self
    {
        $this->name_ru = $name_ru;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|BrandMenu[]
     */
    public function getBrandMenus(): Collection
    {
        return $this->brandMenus;
    }

    public function addBrandMenu(BrandMenu $brandMenu): self
    {
        if (!$this->brandMenus->contains($brandMenu)) {
            $this->brandMenus[] = $brandMenu;
            $brandMenu->setBrand($this);
        }

        return $this;
    }

    public function removeBrandMenu(BrandMenu $brandMenu): self
    {
        if ($this->brandMenus->contains($brandMenu)) {
            $this->brandMenus->removeElement($brandMenu);
            // set the owning side to null (unless already changed)
            if ($brandMenu->getBrand() === $this) {
                $brandMenu->setBrand(null);
            }
        }

        return $this;
    }
}
