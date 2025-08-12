FROM node:22 AS esbuild
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build

FROM dunglas/frankenphp:1-php8.4-alpine AS app
RUN install-php-extensions iconv mbstring pdo_mysql
WORKDIR /app
COPY . .
COPY --from=esbuild /app/public/main.min.js ./public/main.min.js
COPY --from=esbuild /app/public/main.min.css ./public/main.min.css
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --no-interaction
