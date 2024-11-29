# Используем официальный образ PHP с Apache
FROM php:8.2-apache

# Устанавливаем расширения PHP для работы с MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Копируем проект внутрь контейнера
COPY public/ /var/www/html/
COPY src/ /var/www/src/

# Включаем отображение ошибок PHP для разработки
RUN echo "display_errors=On" >> /usr/local/etc/php/php.ini-development \
    && echo "error_reporting=E_ALL" >> /usr/local/etc/php/php.ini-development

# Указываем рабочую директорию
WORKDIR /var/www/html
