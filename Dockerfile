FROM php:7.2
RUN apk add git zip libpng-dev libpq-dev zlib1g-dev
    docker-php-ext-install zip gd bcmath pcntl pdo_pgsql pgsql
    curl --silent --show-error https://getcomposer.org/installer | php
COPY ./ /app/root/
CMD ["php","-S","0.0.0.0:80","-t","/app/root/public"]