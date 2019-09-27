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
    
    public function getAllSectionsHtml(?Brand $brand = null)
    {
        $percent             = $brand ? $brand->getPercent() : 0;
        $price_list_sections = $this->getAllSections($percent);
        
        return $this->twig->render('modules/pricelist.html.twig', compact('brand', 'price_list_sections'));
    }
    
    public function getSingleSectionHtml(Content $content, ?Brand $brand = null)
    {
        if ( ! $content->getPriceTable()) {
            return '';
        }
        $percent             = $brand ? $brand->getPercent() : 0;
        if ($this->brand_menu_repository->isBrandMenu($content->getPath())) {
            $price_list_sections = $this->getSingleSection($content->getPriceTable(), 0, $percent,$content->getName());
        }
        else{
            $price_list_sections = $this->getSingleSection($content->getPriceTable(), $content->getPriceSection(), $percent);
        }
        return $this->twig->render('modules/pricelist.html.twig', compact('brand', 'price_list_sections'));
    }
    
    public function getSingleSection($table, $section_id, $percent,$section_name='')
    {
        $price_list_sections = [];
        $query               = $this->connection
            ->createQueryBuilder()
            ->select('*')
            ->from('`' . $table . '`')
            ->andWhere("rasdel != ''");
        
        if ($section_id) {
            $query->andWhere('nomer_rasdela = :nomer_rasdela')
                  ->setParameter(':nomer_rasdela', $section_id);
        }
        $services = $query->execute()
                          ->fetchAll(\PDO::FETCH_OBJ);
        
        if ($services) {
            foreach ($services as $service) {
                if (empty($price_list_sections[$table])) {
                    $price_list_sections[$table] = new PriceListSection($table, $section_name?:$service->tip, $service, $percent);
                } else {
                    $price_list_sections[$table]->addService($service);
                }
            }
        }
        
        return $price_list_sections;
    }
    
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
}