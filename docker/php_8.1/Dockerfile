FROM php:8.1-fpm

#
RUN apt-get update && apt-get install -y \
        git

# Extensions
RUN docker-php-ext-install pdo_mysql

#Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

CMD ["php-fpm"]