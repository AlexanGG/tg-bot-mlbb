# Используем официальный образ PHP с поддержкой FPM
FROM php:8.2-fpm

# Устанавливаем системные зависимости и расширения PHP для работы с PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /var/www

# Копируем файлы проекта в контейнер
COPY . .

# Устанавливаем зависимости через Composer
RUN composer install --no-dev --optimize-autoloader

# Если используется Laravel, можно выполнить команду для генерации ключа
# RUN php artisan key:generate

# Экспонируем порт (внутри контейнера)
EXPOSE 9000

CMD ["php-fpm"]
