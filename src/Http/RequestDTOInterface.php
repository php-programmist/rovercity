<?php

namespace App\Http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationList;

interface RequestDTOInterface
{
    public function __construct(Request $request);
    public function setErrors(array $errors);
    public function getErrors();
}