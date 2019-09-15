<?php

namespace App\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class MailJsonResponse
{
    /**
     * @param string $msg
     *
     * @return JsonResponse
     */
    public function success(string $msg)
    {
        $response['status'] = true;
        $response['msg']    = $msg;
        
        return new JsonResponse($response);
    }
    
    /**
     * @param $error
     *
     * @return JsonResponse
     */
    public function fail($error)
    {
        $response['status'] = false;
        $response['error'] = $error;
        return new JsonResponse($response);
    }
}