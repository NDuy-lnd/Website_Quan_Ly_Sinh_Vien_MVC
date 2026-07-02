FROM php:8.2-apache

RUN docker-php-ext-install mysqli

RUN a2enmod rewrite

COPY . /var/www/html/QuanLySinhVienMVC

RUN chown -R www-data:www-data /var/www/html/QuanLySinhVienMVC \
    && chmod -R 755 /var/www/html/QuanLySinhVienMVC

RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

EXPOSE 80

CMD ["apache2-foreground"]
