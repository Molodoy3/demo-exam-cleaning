<?php

namespace App\Controllers;

use App\ORM;
use PDO;

class BaseController
{
    protected PDO $pdo;
    public function __construct()
    {
        $this->pdo = ORM::getInstance()->getConnection();
    }

    protected function view(string $fileName, string $title = '', array $data = [], string $templateName = 'default'): void
    {
        extract($data);
        $contentFile = $fileName;
        require_once __DIR__ . "/../Views/Templates/$templateName.php";
    }
}