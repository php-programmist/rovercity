<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Naschiraboty
 *
 * @ORM\Table(name="naschiraboty")
 * @ORM\Entity(repositoryClass="App\Repository\NaschirabotyRepository")
 */
class Naschiraboty
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
     * @ORM\Column(name="meta_desrc", type="string", length=250, nullable=false)
     */
    private $metaDesrc;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", length=65535, nullable=false)
     */
    private $text;

    /**
     * @var int
     *
     * @ORM\Column(name="sort", type="integer", nullable=false)
     */
    private $sort = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="images", type="text", length=65535, nullable=false)
     */
    private $images;

    /**
     * @var string
     *
     * @ORM\Column(name="short_text", type="string", length=250, nullable=false)
     */
    private $shortText;

    /**
     * @var string
     *
     * @ORM\Column(name="client_name", type="string", length=150, nullable=false)
     */
    private $clientName;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=150, nullable=false)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="string", length=255, nullable=false, options={"default"="Mon, 21 May 2018 10:27:57 GMT "})
     */
    private $data = 'Mon, 21 May 2018 10:27:57 GMT ';

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

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(string $metaTitle): self
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    public function getMetaDesrc(): ?string
    {
        return $this->metaDesrc;
    }

    public function setMetaDesrc(string $metaDesrc): self
    {
        $this->metaDesrc = $metaDesrc;

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

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(int $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(string $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getShortText(): ?string
    {
        return $this->shortText;
    }

    public function setShortText(string $shortText): self
    {
        $this->shortText = $shortText;

        return $this;
    }

    public function getClientName(): ?string
    {
        return $this->clientName;
    }

    public function setClientName(string $clientName): self
    {
        $this->clientName = $clientName;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

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
