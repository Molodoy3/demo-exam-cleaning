<?php

namespace App\DTO\User;

class RegisterDTO
{
    public string $full_name = "";
    public string $telephone = "";
    public string $email = "";
    public string $login = "";
    public string $password = "";
    public string $password_confirmation = "";
}