<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function home(): void
    {
        $this->view('home.php', 'Главная');
    }

    public function notFound(): void
    {
        $this->view('notFound.php', 'Страница не найдена');
    }
}