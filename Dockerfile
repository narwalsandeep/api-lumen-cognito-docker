FROM php:7.3-apache
RUN apt-get update && apt-get install -y \
  git \
  vim \
  zip \
  zlib1g-dev
RUN apt-get update -y
RUN apt-get install -y libgmp-dev re2c libmhash-dev libmcrypt-dev file
RUN ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/
RUN docker-php-ext-configure gmp 
RUN docker-php-ext-install gmp
RUN a2enmod rewrite
RUN curl -sS https://getcomposer.org/installer | \
  php -- --install-dir=/usr/local/bin --filename=composer
ARG location=/var/www/html
RUN mkdir -p $location
COPY ./_src $location
COPY ./httpd.conf /etc/apache2/sites-enabled/000-default.conf
WORKDIR $location
RUN chmod -R 0777 .
RUN cp composer.phar /usr/local/bin/composer
RUN composer install 
EXPOSE 80
