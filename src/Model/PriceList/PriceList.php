<?php

namespace App\Model\PriceList;

use App\Repository\ContentRepository;
use Doctrine\DBAL\Connection;

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
            $price_list_sections[] = new PriceListSection($table,$services[0]->tip,$services,$percent);
        }
        return $price_list_sections;
    }
    
    protected function getAllSections($percent = 0)
    {
        $tables = $this->getAllTables();
        $price_list_sections = [];
        foreach ($tables as $table => $section_name) {
            $services = $this->connection
                ->createQueryBuilder()
                ->select('*')
                ->from($table)
                ->where('rasdel != ""')
                ->execute()
                ->fetchAll(\PDO::FETCH_OBJ);
            $price_list_sections[] = new PriceListSection($table,$section_name,$services,$percent);
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
}