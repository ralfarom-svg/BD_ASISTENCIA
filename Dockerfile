FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar proyecto
COPY . /var/www/html

WORKDIR /var/www/html

# Permisos
RUN chown -R www-data:www-data storage bootstrap/cache

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Build frontend
RUN npm install && npm run build

# Apache config
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf

EXPOSE 80
