FROM richarvey/nginx-php-fpm:latest
RUN apk update && apk add git zip openssl unzip libpng-dev
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN set -ex && apk --no-cache add postgresql-dev
RUN docker-php-ext-install zip gd bcmath pcntl pdo_pgsql pgsql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY site.conf /etc/nginx/sites-enabled/default.conf
WORKDIR /my-app
COPY . /my-app
RUN cd /my-app && cp .env.testing .env
RUN composer install