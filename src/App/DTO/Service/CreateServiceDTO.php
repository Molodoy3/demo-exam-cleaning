<?php

namespace App\DTO\Service;

class CreateServiceDTO
{
    public string $address = "";
    public string $contact = "";
    public string $datetime = "";
    public int $service_type_id = 0;
    public int $payload_type_id = 0;
    public int $service_status_id = 0;
}