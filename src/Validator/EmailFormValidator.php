<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\RequestStack;

class EmailFormValidator
{
    private $errors = [];
    private $request;
    
    public function __construct(RequestStack $request_stack)
    {
        $this->request = $request_stack->getCurrentRequest();
    }
    
    public function getValidatedValues( $fields, &$errors)
    {
        $values = [];
        foreach ($fields as $field) {
            $values[$field] = trim($this->request->get($field));
            if (method_exists($this, $field )) {
                $this->$field($values[$field]);
            }
        }
        $errors = $this->getErrors();
        return $values;
    }
    
    public function getErrors()
    {
        return $this->errors;
    }
    
    private function name($value)
    {
        $value = trim($value);
        if (empty($value)) {
            $this->addError("Укажите имя");
            return;
        }
        if (strlen($value) < 2 || preg_match("#[\da-zA-Z]#",$value)) {
            $this->addError("Укажите корректное имя");
            return;
        }
    }
    
    private function subject($value)
    {
        $value = trim($value);
        if (empty($value)) {
            $this->addError("Укажите тему письма");
            return;
        }
        if (strlen($value) < 2) {
            $this->addError("Укажите корректную тему");
            return;
        }
    }
    
    private function phone($value)
    {
        $value = trim($value);
        if (empty($value)) {
            $this->addError("Укажите телефон");
            return;
        }
        if (!preg_match('#\+7\(\d{3}\)\d{3}-\d{2}-\d{2}#',$value)) {
            $this->addError("Укажите корректный телефон");
            return;
        }
    }
    
    
    private function addError($error)
    {
        $this->errors[] = $error;
    }
    
    
}