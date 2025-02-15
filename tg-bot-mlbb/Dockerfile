# Используем официальный PHP образ с FPM
FROM php:8.1-fpm

# Устанавливаем необходимые пакеты для работы с PHP, PostgreSQL и другими расширениями
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    libpq-dev && \
    docker-php-ext-install gd pdo pdo_pgsql

# Копируем исходный код в контейнер
COPY . /var/www/html

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Устанавливаем права на папки и файлы
RUN chown -R www-data:www-data /var/www/html

# Экспонируем порт 9000 для PHP-FPM
EXPOSE 9000

# Запускаем PHP-FPM сервер
CMD ["php-fpm"]
