<?php

namespace App\Controllers;

use App\DTO\User\LoginDTO;
use App\DTO\User\RegisterDTO;
use mysql_xdevapi\Exception;

class UserController extends BaseController
{
    public function register(): void
    {
        $errors = [];
        $registerDTO = new RegisterDTO();
        if (!empty($_POST)) {
            foreach (get_object_vars($registerDTO) as $key => $value) {
                if (isset($_POST[$key])) {
                    $registerDTO->$key = $_POST[$key];
                }
            }

            if (mb_strlen($registerDTO->full_name) < 2 || mb_strlen($registerDTO->full_name) > 20) {
                $errors['full_name'][] = 'ФИО должно быть от 2 до 255 символов';
            } elseif (!preg_match('/^[а-яё\s]+$/ui', $registerDTO->full_name)) {
                $errors['full_name'][] = 'ФИО может содержать только кирилицу';
            }

            if (mb_strlen($registerDTO->login) < 2 || mb_strlen($registerDTO->login) > 20) {
                $errors['login'][] = 'Логин должен быть от 2 до 20 символов';
            } elseif (!preg_match('/^[a-z][a-z0-9_]*[a-z0-9]$/i', $registerDTO->login)) {
                $errors['login'][] = 'Логин может содержать только латинские символы, цифры нижнее подчеркивание. Он не может начинаться с цифры или заканчиваться нижним подчеркиванием';
            }

            if (mb_strlen($registerDTO->email) < 6 || mb_strlen($registerDTO->email) > 255) {
                $errors['email'][] = 'Почта должна быть от 6 до 255 символов';
            } elseif (!filter_var($registerDTO->email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'][] = 'Почта не соответсвует формату';
            }

            if (mb_strlen($registerDTO->telephone) < 9 || mb_strlen($registerDTO->telephone) > 20) {
                $errors['telephone'][] = 'Телефон должен содержать от 9 до 20 символов';
            } elseif (!preg_match('/^[\s0-9-()+]+$/', $registerDTO->telephone)) {
                $errors['telephone'][] = 'Телефон не соответсвует формату';
            }

            if (mb_strlen($registerDTO->password) < 6 || mb_strlen($registerDTO->password) > 20) {
                $errors['telephone'][] = 'Пароль должен содержать от 6 до 20 символов';
            } elseif (!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).+$/u', $registerDTO->password)) {
                $errors['password'][] = 'Пароль должен содержать как минимум одну букву в нижнем регистре, в большом регистре, число и спец символ';
            }

            if ($registerDTO->password !== $registerDTO->password_confirmation) {
                $errors['password_confirmation'][] = 'Пароли не совпадают';
            }

            try {
                if (empty($errors)) {
                    $stmt = $this->pdo->prepare("INSERT INTO users VALUES (
                    NULL,
                    :full_name,
                    :telephone,
                    :email,
                    :password,
                    :login
                )");
                    $stmt->execute([
                        ':full_name' => $registerDTO->full_name,
                        ':telephone' => $registerDTO->telephone,
                        ':email' => $registerDTO->email,
                        ':password' => password_hash($registerDTO->password, PASSWORD_ARGON2ID),
                        ':login' => $registerDTO->login
                    ]);

                    if ($stmt->rowCount() > 0) {
                        $_SESSION['login'] = $registerDTO->login;
                        $_SESSION['is_admin'] = false;
                        header('Location: /');
                        exit();
                    } else {
                        echo 'Произошла ошибка';
                    }
                }
            } catch (Exception $exception) {
                echo $exception->getMessage();
            }
        }

        $this->view('User/register.php', 'Регистрация', [
            'errors' => $errors,
            'registerDTO' => $registerDTO,
        ]);
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /');
    }

    public function login(): void
    {
        $errors = [];
        $loginDTO = new LoginDTO();
        if (!empty($_POST)) {
            foreach (get_object_vars($loginDTO) as $key => $value) {
                if (isset($_POST[$key])) {
                    $loginDTO->$key = $_POST[$key];
                }
            }
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM users WHERE login = :login");
                $stmt->execute([
                    ':login' => $loginDTO->login
                ]);
                $res = $stmt->fetch();
                if ($res && password_verify($loginDTO->password, $res['password'])) {
                    $_SESSION['login'] = $loginDTO->login;
                    $_SESSION['is_admin'] = (bool)$res['is_admin'];
                    header('Location: /');
                } else {
                    $errors['common'][] = 'Данные введены не верно';
                }
            } catch (Exception $exception) {
                echo $exception->getMessage();
            }
        }

        $this->view('User/login.php', 'Авторизация', [
            'errors' => $errors,
            'loginDTO' => $loginDTO,
        ]);
    }
}