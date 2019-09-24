<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Content
 *
 * @ORM\Table(name="content", indexes={@ORM\Index(name="parent", columns={"parent"})})
 * @ORM\Entity(repositoryClass="App\Repository\ContentRepository")
 */
class Content
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
     * @var string|null
     *
     * @ORM\Column(name="path", type="text", length=65535, nullable=true)
     */
    private $path;

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
     * @ORM\Column(name="meta_desrc", type="string", length=450, nullable=false)
     */
    private $metaDesrc;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keywords", type="string", length=250, nullable=false)
     */
    private $metaKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", length=65535, nullable=false)
     */
    private $text;

    /**
     * @var int
     *
     * @ORM\Column(name="parent", type="integer", nullable=false)
     */
    private $parent = '0';
    /**
     * @var string
     *
     * @ORM\Column(name="price_table", type="string",length=250, nullable=true)
     */
    private $priceTable;
    /**
     * @var int
     *
     * @ORM\Column(name="price_section", type="integer", nullable=false)
     */
    private $priceSection = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="sort", type="integer", nullable=false)
     */
    private $sort = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="images_gallery_1", type="text", length=65535, nullable=false)
     */
    private $imagesGallery1;

    /**
     * @var bool
     *
     * @ORM\Column(name="show_in_left_menu", type="boolean", nullable=false)
     */
    private $showInLeftMenu = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="icon_lent_menu", type="string", length=250, nullable=false)
     */
    private $iconLentMenu;

    /**
     * @var string
     *
     * @ORM\Column(name="model_name", type="string", length=150, nullable=false)
     */
    private $modelName;

    /**
     * @var string
     *
     * @ORM\Column(name="icon_model", type="string", length=250, nullable=false)
     */
    private $iconModel;

    /**
     * @var string
     *
     * @ORM\Column(name="redirekt", type="text", length=65535, nullable=false)
     */
    private $redirekt;

    /**
     * @var int
     *
     * @ORM\Column(name="sun_uslugi_menu", type="integer", nullable=false)
     */
    private $sunUslugiMenu = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="string", length=255, nullable=false)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=11, nullable=false)
     */
    private $price = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="rating_value", type="float", precision=2, scale=1, nullable=false, options={"default"="4.6"})
     */
    private $ratingValue = '4.6';

    /**
     * @var int
     *
     * @ORM\Column(name="rating_count", type="integer", nullable=false, options={"default"="12","unsigned"=true})
     */
    private $ratingCount = '12';

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $h1;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

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

    public function getMetaDesrc(): ?string
    {
        return $this->metaDesrc;
    }

    public function setMetaDesrc(string $metaDesrc): self
    {
        $this->metaDesrc = $metaDesrc;

        return $this;
    }

    public function getMetaKeywords(): ?string
    {
        return $this->metaKeywords;
    }

    public function setMetaKeywords(string $metaKeywords): self
    {
        $this->metaKeywords = $metaKeywords;

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

    public function getParent(): ?int
    {
        return $this->parent;
    }

    public function setParent(int $parent): self
    {
        $this->parent = $parent;

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

    public function getImagesGallery1(): ?string
    {
        return $this->imagesGallery1;
    }

    public function setImagesGallery1(string $imagesGallery1): self
    {
        $this->imagesGallery1 = $imagesGallery1;

        return $this;
    }

    public function getShowInLeftMenu(): ?bool
    {
        return $this->showInLeftMenu;
    }

    public function setShowInLeftMenu(bool $showInLeftMenu): self
    {
        $this->showInLeftMenu = $showInLeftMenu;

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

    public function getModelName(): ?string
    {
        return $this->modelName;
    }

    public function setModelName(string $modelName): self
    {
        $this->modelName = $modelName;

        return $this;
    }

    public function getIconModel(): ?string
    {
        return $this->iconModel;
    }

    public function setIconModel(string $iconModel): self
    {
        $this->iconModel = $iconModel;

        return $this;
    }

    public function getRedirekt(): ?string
    {
        return $this->redirekt;
    }

    public function setRedirekt(string $redirekt): self
    {
        $this->redirekt = $redirekt;

        return $this;
    }

    public function getSunUslugiMenu(): ?int
    {
        return $this->sunUslugiMenu;
    }

    public function setSunUslugiMenu(int $sunUslugiMenu): self
    {
        $this->sunUslugiMenu = $sunUslugiMenu;

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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRatingValue(): ?float
    {
        return $this->ratingValue;
    }

    public function setRatingValue(float $ratingValue): self
    {
        $this->ratingValue = $ratingValue;

        return $this;
    }

    public function getRatingCount(): ?int
    {
        return $this->ratingCount;
    }

    public function setRatingCount(int $ratingCount): self
    {
        $this->ratingCount = $ratingCount;

        return $this;
    }

    public function getH1(): ?string
    {
        return $this->h1;
    }

    public function setH1(?string $h1): self
    {
        $this->h1 = $h1;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getPriceTable(): ?string
    {
        return $this->priceTable;
    }
    
    /**
     * @param string $priceTable
     */
    public function setPriceTable(string $priceTable): void
    {
        $this->priceTable = $priceTable;
    }
    
    /**
     * @return int
     */
    public function getPriceSection(): int
    {
        return $this->priceSection;
    }
    
    /**
     * @param int $priceSection
     */
    public function setPriceSection(int $priceSection): void
    {
        $this->priceSection = $priceSection;
    }
    
}
