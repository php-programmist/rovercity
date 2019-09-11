<?php

namespace App\Controller;


use App\Repository\ContentRepository;
use App\Service\TemplateResolverService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class PageController extends BaseController
{
    public function dynamic_pages($token,ContentRepository $content_repository,TemplateResolverService $template_resolver)
    {
        if (!$content_entity = $content_repository->findOneBy(['path' => '/' . $token . '/'])) {
            throw new NotFoundHttpException();
        }
        $template_name = $template_resolver->getTemplateName($token);
        return $this->render($template_name, [
            'content' => $content_entity,
        ]);
    }
}
