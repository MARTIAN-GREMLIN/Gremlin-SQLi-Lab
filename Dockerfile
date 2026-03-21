FROM php:8. AS apache

WORKDIR /Var/www/html

RUN a2enmod rewrite 
RUN apt-get update && apt-get install -y \mysql-client \&& rm -rf /Var/lib/apt/lists/*

RUN docker-php-ext-install mysqli pdo pd_mysql

COPY app/ /Var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]

