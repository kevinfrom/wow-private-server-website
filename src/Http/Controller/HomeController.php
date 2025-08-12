<?php

declare(strict_types=1);

namespace App\Http\Controller;

final readonly class HomeController
{
    public function index(): never
    {
        require_once TEMPLATES_DIR . DS . 'index.php';
        exit;
    }
}
