<?php

namespace App\Http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestDTOResolver implements ArgumentValueResolverInterface
{
    private $validator;
    
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }
    
    public function supports(Request $request, ArgumentMetadata $argument)
    {
        $reflection = new \ReflectionClass($argument->getType());
        if ($reflection->implementsInterface(RequestDTOInterface::class)) {
            return true;
        }
        
        return false;
    }
    
    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        // creating new instance of custom request DTO
        $class = $argument->getType();
        $dto = new $class($request);
        
        // throw bad request exception in case of invalid request data
        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            throw new BadRequestHttpException( $errors[0]->getMessage());
        }
        
        yield $dto;
    }
}