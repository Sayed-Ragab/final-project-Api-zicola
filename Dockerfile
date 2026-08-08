FROM php:8.2-fpm

# Install required packages and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    default-mysql-client \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    zip \
    intl \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Node.js 22
COPY --from=node:22 /usr/local /usr/local

WORKDIR /var/www

# Copy Composer files first for Docker cache
COPY composer.json composer.lock ./

# Install PHP dependencies without running Laravel scripts yet
RUN composer install --no-interaction --prefer-dist --no-scripts

# Copy the application
COPY . .

# Run Laravel package discovery after artisan is available
RUN php artisan package:discover --ansi

# Install frontend dependencies and build Vite
RUN npm install
RUN npm run build

# Set Laravel permissions
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]