FROM php:8.2-fpm

# تثبيت الأدوات المطلوبة
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql zip

# تثبيت Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# تثبيت Node.js 22
COPY --from=node:22 /usr/local /usr/local

WORKDIR /var/www

# نسخ ملفات Composer أولًا للاستفادة من الكاش
COPY composer.json composer.lock ./

# منع Composer scripts مؤقتًا لأن artisan لم يتم نسخه بعد
RUN composer install --no-interaction --prefer-dist --no-scripts

# نسخ باقي المشروع
COPY . .

# تشغيل Composer scripts بعد وجود artisan
RUN php artisan package:discover --ansi

# تثبيت مكتبات الفرونت الخاصة بـ Laravel وبناء Vite
RUN npm install
RUN npm run build

# صلاحيات Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]