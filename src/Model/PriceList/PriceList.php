<?php

namespace App\Model\PriceList;

use App\Repository\ContentRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

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
    
    public function __construct(Connection $connection,ContentRepository $content_repository)
    {
        $this->connection = $connection;
        $this->content_repository = $content_repository;
    }
    
    public function getPriceData($token,$percent = 0)
    {
        if ($content = $this->content_repository->findOneBy(['path'=>'/'.$token.'/'])) {
            if ($content->getPriceTable()) {
                return $this->getSingleSection($content->getPriceTable(),$content->getPriceSection(),$percent);
            }
        }
    
        return $this->getAllSections($percent);
    }
    
    protected function getSingleSection($table, $section_id,$percent)
    {
        $price_list_sections = [];
        $services = $this->connection
            ->createQueryBuilder()
            ->select('*')
            ->from($table)
            ->where('rasdel != ""')
            ->where('nomer_rasdela = '.$section_id)
            ->execute()
            ->fetchAll(\PDO::FETCH_OBJ);
        if ($services) {
            foreach ($services as $service) {
                if (empty($price_list_sections[$table])) {
                    $price_list_sections[$table] = new PriceListSection($table,$service->tip,$service,$percent);
                }
                else{
                    $price_list_sections[$table]->addService($service);
                }
            }
        }
        return $price_list_sections;
    }
    
    protected function getAllSections($percent = 0)
    {
        $tables = $this->getAllTables();
        $price_list_sections = [];
        $builders = [];
        foreach ($tables as $table => $section_name) {
            $builders[] = $this->connection
                ->createQueryBuilder()
                ->select('rasdel,normo_chas,cena, "'.$table.'" as table_name')
                ->from($table)
                ->where('rasdel != ""');
        }
        $sql = $this->getUnionBuilders($builders);
        $this->connection->setFetchMode(\PDO::FETCH_OBJ);
        $services = $this->connection->fetchAll($sql);
        foreach ($services as $service) {
            if (empty($price_list_sections[$service->table_name])) {
                $price_list_sections[$service->table_name] = new PriceListSection($service->table_name,$tables[$service->table_name],$service,$percent);
            }
            else{
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
        $queries=[];
        foreach ($builders as $builder) {
            $queries[] = $builder->getSQL();
        }
        return implode(' UNION ',$queries);
    }
}