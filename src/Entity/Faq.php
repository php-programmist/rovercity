<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Faq
 *
 * @ORM\Table(name="faq")
 * @ORM\Entity(repositoryClass="App\Repository\FaqRepository")
 */
class Faq
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
     * @ORM\Column(name="autor", type="string", length=250, nullable=false)
     */
    private $autor;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=250, nullable=false)
     */
    private $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="string", length=250, nullable=false)
     */
    private $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="zagolovok", type="string", length=250, nullable=false)
     */
    private $zagolovok;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", length=65535, nullable=false)
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="email_autor", type="string", length=250, nullable=false)
     */
    private $emailAutor;

    /**
     * @var int
     *
     * @ORM\Column(name="date", type="integer", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="otvet_admin", type="text", length=65535, nullable=false)
     */
    private $otvetAdmin;

    /**
     * @var bool
     *
     * @ORM\Column(name="enable", type="boolean", nullable=false)
     */
    private $enable = '0';

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
     * @ORM\Column(name="data", type="string", length=255, nullable=false, options={"default"="Mon, 21 May 2018 10:27:57 GMT "})
     */
    private $data = 'Mon, 21 May 2018 10:27:57 GMT ';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): self
    {
        $this->autor = $autor;

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

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(string $metaDescription): self
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    public function getZagolovok(): ?string
    {
        return $this->zagolovok;
    }

    public function setZagolovok(string $zagolovok): self
    {
        $this->zagolovok = $zagolovok;

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

    public function getEmailAutor(): ?string
    {
        return $this->emailAutor;
    }

    public function setEmailAutor(string $emailAutor): self
    {
        $this->emailAutor = $emailAutor;

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

    public function getOtvetAdmin(): ?string
    {
        return $this->otvetAdmin;
    }

    public function setOtvetAdmin(string $otvetAdmin): self
    {
        $this->otvetAdmin = $otvetAdmin;

        return $this;
    }

    public function getEnable(): ?bool
    {
        return $this->enable;
    }

    public function setEnable(bool $enable): self
    {
        $this->enable = $enable;

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
