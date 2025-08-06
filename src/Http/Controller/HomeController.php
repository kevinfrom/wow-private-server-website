<?php

declare(strict_types=1);

namespace App\Http\Controller;

final readonly class HomeController
{
    public function index(): never
    {
        readfile(TEMPLATES_DIR . DS . 'index.html');
        exit;
    }
}
