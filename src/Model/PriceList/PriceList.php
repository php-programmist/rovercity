<?php

namespace App\Model\PriceList;

use App\Entity\Brand;
use App\Entity\Content;
use App\Repository\BrandMenuRepository;
use App\Repository\ContentRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Twig\Environment;

class PriceList
{
    /**
     * @var Connection
     */
    protected $connection;
    /**
     * @var ContentRepository
     */
    protected $content_repository;
    /**
     * @var Environment
     */
    protected $twig;
    /**
     * @var BrandMenuRepository
     */
    protected $brand_menu_repository;
    
    public function __construct(
        Connection $connection,
        ContentRepository $content_repository,
        Environment $twig,
        BrandMenuRepository $brand_menu_repository
    ) {
        $this->connection            = $connection;
        $this->content_repository    = $content_repository;
        $this->twig                  = $twig;
        $this->brand_menu_repository = $brand_menu_repository;
    }
    
    /**
     * Возвращает отрендеренный прайс услу из всех таблиц
     * Выводить на главной и страницах марок и моделей
     * @param string $price_list_header - заголовок для прайса
     * @param Brand|null $brand
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function getAllSectionsHtml($price_list_header, ?Brand $brand = null)
    {
        $percent             = $brand ? $brand->getPercent() : 0;
        $price_list_sections = $this->getAllSections($percent);
        $price_list_header   = $this->preparePriceHeader($price_list_header);
        
        return $this->twig->render('modules/pricelist.html.twig',
            compact('brand', 'price_list_sections', 'price_list_header'));
    }
    
    /**
     * Возвращает отрендеренный прайс услуг из таблицы, которая указана в $content->getPriceTable()
     * Выводить на странице услуг
     * @param Content    $content
     * @param Brand|null $brand
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function getSingleSectionHtml(Content $content, ?Brand $brand = null)
    {
        if ( ! $content->getPriceTable()) {
            return '';
        }
        
        $price_list_header = $this->preparePriceHeader($content->getH1() . ' Цена:');
        
        $percent = $brand ? $brand->getPercent() : 0;
        if ($this->brand_menu_repository->isBrandMenu($content->getPath())) {
            if ( ! $services = $this->getSingleTable($content->getPriceTable(), 0)) {
                return '';
            }
            $price_list_sections = $this->groupSubSections($services, $percent);
        } else {
            if ( ! $services = $this->getSingleTable($content->getPriceTable(), $content->getPriceSection())) {
                return '';
            }
            $price_list_sections = $this->groupOneSection($services, $percent);
        }
        
        return $this->twig->render('modules/pricelist.html.twig',
            compact('brand', 'price_list_sections', 'price_list_header'));
    }
    
    /**
     * Возвращает массив услуг из одной таблицы
     * @param $table - название таблицы услуг
     * @param $section_id - номер раздела услуг. 0 - будут выбраны услугих из всех разделов
     *
     * @return mixed[]
     */
    public function getSingleTable($table, $section_id)
    {
        $query = $this->connection
            ->createQueryBuilder()
            ->select('rasdel,normo_chas,cena,nomer_rasdela,tip, "' . $table . '" as table_name')
            ->from('`' . $table . '`')
            ->andWhere("rasdel != ''");
        
        if ($section_id) {
            $query->andWhere('nomer_rasdela = :nomer_rasdela')
                  ->setParameter(':nomer_rasdela', $section_id);
        }
        $services = $query->execute()
                          ->fetchAll(\PDO::FETCH_OBJ);
        
        return $services;
    }
    
    /**
     * Возвращает массив секций услуг. Одна секция - одна таблица
     * @param int $percent - на данный процент будет изменена цена всех услуг
     *
     * @return array
     */
    public function getAllSections($percent = 0)
    {
        $tables              = $this->getAllTables();
        $price_list_sections = [];
        $builders            = [];
        foreach ($tables as $table => $section_name) {
            $builders[] = $this->connection
                ->createQueryBuilder()
                ->select('rasdel,normo_chas,cena, "' . $table . '" as table_name')
                ->from('`' . $table . '`')
                ->andWhere("rasdel != ''");
        }
        $sql = $this->getUnionBuilders($builders);
        $this->connection->setFetchMode(\PDO::FETCH_OBJ);
        $services = $this->connection->fetchAll($sql);
        foreach ($services as $service) {
            if (empty($price_list_sections[$service->table_name])) {
                $price_list_sections[$service->table_name] = new PriceListSection($service->table_name,
                    $tables[$service->table_name], $service, $percent);
            } else {
                $price_list_sections[$service->table_name]->addService($service);
            }
        }
        
        return $price_list_sections;
    }
    
    /**
     * Возвращает одну секцию из всего раздела
     *
     * @param $services
     *
     * @param $percent
     *
     * @return array
     */
    public function groupOneSection($services, $percent): array
    {
        $price_list_sections = [];
        foreach ($services as $service) {
            if (empty($price_list_sections[$service->table_name])) {
                $price_list_sections[$service->table_name] = new PriceListSection($service->table_name, $service->tip,
                    $service, $percent);
            } else {
                $price_list_sections[$service->table_name]->addService($service);
            }
        }
        
        return $price_list_sections;
    }
    
    /**
     * Группирует список услуг всего раздела в несколько секций
     *
     * @param $services
     * @param $percent
     *
     * @return array
     */
    public function groupSubSections($services, $percent): array
    {
        $price_list_sections = [];
        foreach ($services as $service) {
            if (empty($price_list_sections[$service->nomer_rasdela])) {
                $price_list_sections[$service->nomer_rasdela] = new PriceListSection($service->table_name,
                    $service->tip, $service, $percent);
            } else {
                $price_list_sections[$service->nomer_rasdela]->addService($service);
            }
        }
        
        return $price_list_sections;
    }
    
    private function getAllTables()
    {
        return [
            'price_lr_to'                         => 'Техническое обслуживание',
            'price_rr_diagnostika'                => 'Диагностика',
            'price_rr_dvigatel'                   => 'Ремонт двигателя',
            'price_lr_remont_diselnix_dvagatelei' => 'Ремонт дизельного двигателя',
            'price_rr_transmissiya'               => 'Ремонт трансмиссии',
            'price_rr_electrica'                  => 'Ремонт электрооборудования',
            'price_rr_xodovaya'                   => 'Ремонт ходовой',
            'price_rr_tozmoznaya_systema'         => 'Тормозная система',
            'price_rr_kuzovnoi_remont'            => 'Кузовной ремонт',
            'price_rr_pokraska'                   => 'Покраска кузова',
            'price_rr_stekla'                     => 'Замена стёкол',
            'price_rr_deteiling'                  => 'Детейлинг',
        ];
    }
    
    /**
     * @param QueryBuilder[] $builders
     *
     * @return string
     */
    private function getUnionBuilders($builders)
    {
        $queries = [];
        foreach ($builders as $builder) {
            $queries[] = $builder->getSQL();
        }
        
        return implode(' UNION ', $queries);
    }
    
    /**
     * @param $price_list_header
     *
     * @return null|string
     */
    protected function preparePriceHeader($price_list_header)
    {
        return preg_replace('# в москве#ui', '', $price_list_header);
    }
}