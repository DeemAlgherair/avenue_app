# استخدم صورة PHP مع FPM
FROM php:8.2-fpm

# تثبيت امتدادات PHP الضرورية
RUN docker-php-ext-install pdo pdo_mysql

# نسخ ملفات التطبيق إلى /var/www/html
COPY . /var/www/html

# إعداد الأذونات
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html