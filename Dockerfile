# Dockerfile
FROM php:8.3-fpm

# Установка зависимостей и PDO MySQL драйвера
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql zip

# Можно также установить другие полезные расширения
# RUN docker-php-ext-install mysqli pdo_pgsql opcache