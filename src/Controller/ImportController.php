<?php

namespace App\Controller;

use App\Entity\Content;
use App\Entity\SpecialOffer;
use App\Repository\ContentRepository;
use App\Service\FilesExplorerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ImportController extends AbstractController
{
    
    /**
     * @var EntityManagerInterface
     */
    protected $em;
    /**
     * @var FilesExplorerService
     */
    protected $files_explorer;
    
    public function __construct(EntityManagerInterface $em,FilesExplorerService $files_explorer)
    {
        $this->em = $em;
        $this->files_explorer = $files_explorer;
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
    
    public function clearContent(ContentRepository $content_repository)
    {
        $process = 0;
        $pages = $content_repository->findAll();
        $counter = 0;
        //$pattern = '#<div class="h2_div_top">Прайс-лист на все виды работ:</div>[\s\S]+?<p>\[callback_buttons\]</p>#';
        $pattern = '#<div class="h2_div_top">Прайс-лист на все виды работ:</div>[\s\S]+?<p></p>#';
        // $pattern = '#<div class="h2_div_top">Прайс-лист на все виды работ:</div>[\s\S]+?(?=<h(3|2)>)#';
        //$pattern = '#<div class="galerss_new_viks"[\s\S]+?</div>#';
        foreach ($pages as $page) {
            if (preg_match($pattern,$page->getText(),$matches)) {
                
                if ($process) {
                    $new_text = preg_replace($pattern,'',$page->getText());
                    $page->setText($new_text);
                }
                else{
                    dump($page->getText());
                    dump($matches);
                }
                
                $counter++;
            }
        }
        if ($process) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }
        dd($counter);
    }
    public function changeHeaders(ContentRepository $content_repository)
    {
        $process = 1;
        $counter = 0;
        $start_time = time();
        $pages = $content_repository->findAll();
        $em = $this->getDoctrine()->getManager();
        
        //$pattern = '#<h1>([\s\S]+?)</h1>#';
        $pattern = '#<h1 id="elemVacancy">([\s\S]+?)</h1>#';
        //$pattern = '#<h1></h1>#';
        
        // $replace = '<h2>$1</h2>';
        $replace = '';
        
        foreach ($pages as $page) {
            if (preg_match($pattern,$page->getText(),$matches)) {
                $new_text = preg_replace($pattern,$replace,$page->getText());
                if ($process) {
                    $page->setText(trim($new_text));
                     $page->setH1($matches[1]);
                     //$page->setH1($page->getName());
                }
                else{
                    //dump($page->getText());
                    dump($matches);
                    dump($new_text);
                    echo '<hr><hr>';
                    
                }
                
                $counter++;
            }
            if ($process && time()-$start_time > 170) {
                $em->flush();
                dd($counter);
            }
        }
        if ($process) {
            $em->flush();
        }
        dd($counter);
    }
    
    public function ourWorksImages()
    {
        $images = $this->files_explorer->getImagesFromFolder('img/our_works/transmission',false);
        
        $tables = [
            'price_frelander_transmissiya',
            'price_lr_transmissya',
            'price_rr_transmissiya',
        ];
        $content_repo = $this->em->getRepository(Content::class);
        $counter=0;
        foreach ($tables as $table) {
            $pages = $content_repo->findBy(['priceTable'=>$table]);
            foreach ($pages as $page) {
                $random_images = array_rand(array_flip($images), 8);
                shuffle($random_images);
                $random_images = array_map(function ($item){
                    return 'transmission/'.$item;
                },$random_images);
                $page->setImagesGallery($random_images);
                $counter++;
            }
        }
        $this->em->flush();
        dd($counter);
    }
    
}
