<?php

namespace App\Request;

interface MailRequestInterface
{
    public function getPhone();
    public function getSubject();
}