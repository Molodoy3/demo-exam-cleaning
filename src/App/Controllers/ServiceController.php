<?php

namespace App\Controllers;

use App\DTO\Service\CreateServiceDTO;
use PDO;

class ServiceController extends BaseController
{

    public function create(): void
    {
        $createServicePDO = new CreateServiceDTO();
        $errors = [];

        if (!empty($_POST)) {
            foreach (get_object_vars($createServicePDO) as $key => $value) {
                if (!empty($_POST[$key])) {
                    $createServicePDO->$key = $_POST[$key];
                }
                if (empty($createServicePDO->$key)) {
                    $errors[$key][] = 'Обязательное поле';
                }
            }

            if (mb_strlen($createServicePDO->address) > 255) {
                $errors['address'][] = 'Адрес не может содержать более 255 символов';
            }
            if (mb_strlen($createServicePDO->contact) > 255) {
                $errors['address'][] = 'Контактные данные не могут содержать более 255 символов';
            }

            if (empty($errors)) {
                $login = $_SESSION['login'];
                $userId = $this->pdo->query("SELECT user_id FROM users WHERE login = '$login'")->fetch()['user_id'];

                $stmt = $this->pdo->prepare("INSERT INTO services VALUES (
                    NULL,
                    :address,
                    :contact,
                    :datetime,
                    :service_type_id,
                    :paylooad_type_id,
                    NULL,
                    NULL,
                    :user_id
                )");
                $stmt->execute([
                    ':address' => $createServicePDO->address,
                    ':contact' => $createServicePDO->contact,
                    ':datetime' => str_replace('T', ' ', $createServicePDO->datetime),
                    ':service_type_id' => $createServicePDO->service_type_id,
                    ':paylooad_type_id' => $createServicePDO->paylooad_type_id,
                    ':user_id' => $userId,
                ]);

                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    "public/img/" . $this->pdo->lastInsertId() . ".jpg"
                );

                header('Location: /services');
                exit();
            }
        }

        $this->view('Service/create.php', 'Создание заявки', [
            'createServicePDO' => $createServicePDO,
            'errors' => $errors,
            'serviceTypes' => $this->pdo->query('SELECT * FROM service_types')->fetchAll(PDO::FETCH_ASSOC),
            'payloadTypes' => $this->pdo->query('SELECT * FROM paylooad_types')->fetchAll(PDO::FETCH_ASSOC),
        ]);
    }

    public function services(): void
    {
        $login = $_SESSION['login'];
        $userId = $this->pdo->query("SELECT user_id FROM users WHERE login = '$login'")->fetch()['user_id'];

        $this->view('Service/services.php', 'Мои заявки', [
            'services' => $this->pdo->query("
                    SELECT 
                        services.*,
                        service_types.name AS service_types_name,
                        service_statuses.name AS service_statuses_name
                    FROM services
                    LEFT JOIN service_types ON services.service_type_id = service_types.service_type_id
                    LEFT JOIN service_statuses ON services.service_status_id = service_statuses.service_statuse_id
                    WHERE user_id = '$userId'")
                ->fetchAll(PDO::FETCH_ASSOC),
        ]);
    }

    public function manager(): void
    {
        $this->view('Service/manager.php', 'Управление заявками', [
            'services' => $this->pdo->query("
                    SELECT 
                        services.*,
                        service_types.name AS service_types_name,
                        service_statuses.name AS service_statuses_name
                    FROM services
                    LEFT JOIN service_types ON services.service_type_id = service_types.service_type_id
                    LEFT JOIN service_statuses ON services.service_status_id = service_statuses.service_statuse_id")
                ->fetchAll(PDO::FETCH_ASSOC),
        ]);
    }

    public function editStatus(): void
    {
        $serviceId = $_GET['id'];

        if (!empty($_POST)) {
            $this->pdo->prepare('UPDATE services SET service_status_id = :service_status_id WHERE service_id = :service_id')->execute([
                ':service_status_id' => $_POST['service_status_id'],
                ':service_id' => $serviceId,
            ]);
            header('Location: /service/manager');
            exit();
        }

        $this->view('Service/edit-status.php', 'Управление заявками', [
            'service' => $this->pdo->query("
                    SELECT 
                        services.*,
                        service_types.name AS service_types_name,
                        service_statuses.name AS service_statuses_name,
                        services.service_status_id
                    FROM services
                    LEFT JOIN service_types ON services.service_type_id = service_types.service_type_id
                    LEFT JOIN service_statuses ON services.service_status_id = service_statuses.service_statuse_id
                    WHERE services.service_id = '$serviceId'")
                ->fetch(),
            "statuses" => $this->pdo->query('SELECT * FROM service_statuses')->fetchAll(PDO::FETCH_ASSOC),
        ]);
    }
}