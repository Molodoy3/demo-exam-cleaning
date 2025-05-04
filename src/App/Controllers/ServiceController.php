<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\DTO\Service\CreateServiceDTO;
use PDO;

class ServiceController extends BaseController
{

    public function create(): void
    {
        $createServicePDO = new CreateServiceDTO();
        $errors = [];
        var_dump($_POST);
        if (!empty($_POST)) {
            foreach (get_object_vars($createServicePDO) as $key => $value) {
                if (!empty($_POST[$key])) {
                    $createServicePDO->$key = $_POST[$key];
                } else {
                    $errors[$key][] = 'Обязательное поле';
                }
            }
        }

        $this->view('Service/create.php', 'Создание заявки', [
            'createServicePDO' => $createServicePDO,
            'errors' => $errors,
            'serviceTypes' => $this->pdo->query('SELECT * FROM service_types')->fetchAll(PDO::FETCH_ASSOC),
            'payloadTypes' => $this->pdo->query('SELECT * FROM paylooad_types')->fetchAll(PDO::FETCH_ASSOC),
        ]);
    }
}