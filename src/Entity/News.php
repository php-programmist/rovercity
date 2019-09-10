<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 */
class News
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
     * @ORM\Column(name="meta_descr", type="string", length=250, nullable=false)
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
    private $countViews = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="count_like", type="integer", nullable=false)
     */
    private $countLike = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="count_dislike", type="integer", nullable=false)
     */
    private $countDislike = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="images_gallery_1", type="text", length=65535, nullable=false)
     */
    private $imagesGallery1;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="string", length=255, nullable=false)
     */
    private $data = '';

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCountLike(): ?int
    {
        return $this->countLike;
    }

    public function setCountLike(int $countLike): self
    {
        $this->countLike = $countLike;

        return $this;
    }

    public function getCountDislike(): ?int
    {
        return $this->countDislike;
    }

    public function setCountDislike(int $countDislike): self
    {
        $this->countDislike = $countDislike;

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

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }


}
