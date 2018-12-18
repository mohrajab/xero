FROM richarvey/nginx-php-fpm:latest
RUN apk update && apk add git zip openssl unzip libpng-dev
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN set -ex && apk --no-cache add postgresql-dev
RUN docker-php-ext-install bcmath pcntl pdo_pgsql pgsql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY site.conf /etc/nginx/sites-enabled/default.conf
WORKDIR /var/www
ADD . /var/www
RUN cd /var/www && cp .env.testing .env
COPY /var/www/storage /var/www/storage-alter
RUN composer install
RUN php artisan migrate:fresh --seed
RUN chown -R www-data:www-data /var/www
RUN chmod -R 777 /var/www/storage