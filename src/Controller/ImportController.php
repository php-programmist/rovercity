<?php

namespace App\Controller;

use App\Entity\SpecialOffer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ImportController extends AbstractController
{
    
    /**
     * @var EntityManagerInterface
     */
    protected $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    public function special_offers()
    {
        $actions = [
            [
                'name'        => 'Бесплатная диагностика',
                'description' => 'Комплексная диагностика по 56 параметрам',
                'old_price'   => '3000',
                'new_price'   => '0',
            ],
            [
                'name'        => 'Эвакуация автомобиля',
                'description' => 'Бесплатно при ремонте в нашем автосервисе. Эвакуатор работает с 09 до 21 часа (без выходных).',
                'old_price'   => '4000',
                'new_price'   => '0',
            ],
            [
                'name'        => 'Замена масла в подарок',
                'description' => 'При покупке масла и фильтра у нас',
                'old_price'   => '1800',
                'new_price'   => '0',
            ],
            [
                'name'        => 'Заправка кондиционера',
                'description' => 'Диагностика и заправка автокондиционера #BRAND',
                'old_price'   => '2800',
                'new_price'   => '1699',
            ],
            [
                'name'        => 'Очистка кондиционера',
                'description' => 'Полная очистка системы кондиционирования #BRAND',
                'old_price'   => '2500',
                'new_price'   => '1500',
            ],
            [
                'name'        => 'Мойка радиаторов охлаждения',
                'description' => 'Снятие/установка/чистка/спецсредства',
                'old_price'   => '9500',
                'new_price'   => '6999',
            ],
            [
                'name'        => 'Бесплатная мойка',
                'description' => 'При прохождении ТО и ремонте мойка в подарок',
                'old_price'   => '400',
                'new_price'   => '0',
            ],
        ];
    
        foreach ($actions as $action) {
            $offer = new SpecialOffer();
            $offer->setName($action['name']);
            $offer->setDescription($action['description']);
            $offer->setOldPrice($action['old_price']);
            $offer->setNewPrice($action['new_price']);
            $this->em->persist($offer);
        }
        $this->em->flush();
        dd("ok");
    }
    
}
