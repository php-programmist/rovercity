<?php

namespace App\Controller;

use App\Repository\ContentRepository;
use App\Service\CommonDataService;
use App\Service\TemplateResolverService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class PageController extends AbstractController
{
    /**
     * @var CommonDataService
     */
    protected $common_data_service;
    
    public function __construct(CommonDataService $common_data_service)
    {
        $this->common_data_service = $common_data_service;
    }
    
    public function index(ContentRepository $content_repository)
    {
        if (!$content_entity = $content_repository->findOneBy(['path' => '/'])) {
            throw new NotFoundHttpException();
        }
        return $this->render('page/index.html.twig', $this->common_data_service->addCommonData([
            'content' => $content_entity,
        ],'/'));
    }
    
    public function dynamic_pages($token,ContentRepository $content_repository,TemplateResolverService $template_resolver)
    {
        if (!$content_entity = $content_repository->findOneBy(['path' => '/' . $token . '/'])) {
            throw new NotFoundHttpException();
        }
        $template_name = $template_resolver->getTemplateName($token);
        return $this->render($template_name, $this->common_data_service->addCommonData([
            'content' => $content_entity,
        ],$token));
    }
}
