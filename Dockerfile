FROM php:7.2
RUN apt-get update
RUN apt-get install -y --no-install-recommends git zip libpng-dev libjpeg-dev libpq-dev zlib1g-dev libfreetype6-dev
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install zip gd bcmath pcntl pdo_pgsql pgsql
RUN curl --silent --show-error https://getcomposer.org/installer | php
COPY ./ /app/root/
CMD ["php","-S","0.0.0.0:80","-t","/app/root/public"]