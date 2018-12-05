FROM php:7.2
RUN apt-get update
RUN apt-get install -y --no-install-recommends git zip libpng-dev libpq-dev zlib1g-dev
RUN docker-php-ext-install zip gd bcmath pcntl pdo_pgsql pgsql
RUN curl --silent --show-error https://getcomposer.org/installer | php && chmod +x composer.phar && mv composer.phar /usr/local/bin/composer
COPY ./ /app/root/
RUN cd /app/root/ && cp .env.testing .env && composer install -n --prefer-dist && php artisan storage:link
CMD ["php","-S","0.0.0.0:80","-t","/app/root/public"]