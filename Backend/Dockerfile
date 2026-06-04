# Backend Dockerfile
FROM php:8.2-fpm-alpine
RUN apk add --no-cache git curl libpng-dev libxml2-dev zip unzip postgresql-dev oniguruma-dev
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
EXPOSE 9000
CMD ["php-fpm"]
