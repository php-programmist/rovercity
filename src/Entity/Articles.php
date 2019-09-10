<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Articles
 *
 * @ORM\Table(name="articles")
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
 */
class Articles
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=250, nullable=false)
     */
    private $path;

    /**
     * @var int
     *
     * @ORM\Column(name="date", type="integer", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=250, nullable=false)
     */
    private $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_descr", type="text", length=65535, nullable=false)
     */
    private $metaDescr;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", length=65535, nullable=false)
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="short_descr", type="text", length=65535, nullable=false)
     */
    private $shortDescr;

    /**
     * @var int
     *
     * @ORM\Column(name="count_views", type="integer", nullable=false)
     */
    private $countViews;

    /**
     * @var string
     *
     * @ORM\Column(name="images_gallery_1", type="text", length=65535, nullable=false)
     */
    private $imagesGallery1;

    /**
     * @var string
     *
     * @ORM\Column(name="icon_lent_menu", type="string", length=250, nullable=false)
     */
    private $iconLentMenu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getDate(): ?int
    {
        return $this->date;
    }

    public function setDate(int $date): self
    {
        $this->date = $date;

        return $this;
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

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(string $metaTitle): self
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    public function getMetaDescr(): ?string
    {
        return $this->metaDescr;
    }

    public function setMetaDescr(string $metaDescr): self
    {
        $this->metaDescr = $metaDescr;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getShortDescr(): ?string
    {
        return $this->shortDescr;
    }

    public function setShortDescr(string $shortDescr): self
    {
        $this->shortDescr = $shortDescr;

        return $this;
    }

    public function getCountViews(): ?int
    {
        return $this->countViews;
    }

    public function setCountViews(int $countViews): self
    {
        $this->countViews = $countViews;

        return $this;
    }

    public function getImagesGallery1(): ?string
    {
        return $this->imagesGallery1;
    }

    public function setImagesGallery1(string $imagesGallery1): self
    {
        $this->imagesGallery1 = $imagesGallery1;

        return $this;
    }

    public function getIconLentMenu(): ?string
    {
        return $this->iconLentMenu;
    }

    public function setIconLentMenu(string $iconLentMenu): self
    {
        $this->iconLentMenu = $iconLentMenu;

        return $this;
    }


}
