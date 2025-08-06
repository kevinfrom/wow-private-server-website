FROM dunglas/frankenphp:1-php8.4-alpine
RUN install-php-extensions iconv pdo_mysql
WORKDIR /app
COPY . .
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --no-interaction
