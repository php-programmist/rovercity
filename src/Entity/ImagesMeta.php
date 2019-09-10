<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImagesMeta
 *
 * @ORM\Table(name="images_meta")
 * @ORM\Entity(repositoryClass="App\Repository\ImagesMetaRepository")
 */
class ImagesMeta
{
    /**
     * @var bool
     *
     * @ORM\Column(name="id", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="img_name", type="string", length=500, nullable=false)
     */
    private $imgName;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=350, nullable=false)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=350, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=350, nullable=false)
     */
    private $url;

    public function getId(): ?bool
    {
        return $this->id;
    }

    public function getImgName(): ?string
    {
        return $this->imgName;
    }

    public function setImgName(string $imgName): self
    {
        $this->imgName = $imgName;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }


}
