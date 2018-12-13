FROM richarvey/nginx-php-fpm:latest
RUN apk update && apk add git zip libpng-dev libjpeg-dev libpq-dev zlib1g-dev libfreetype6-dev
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install zip gd bcmath pcntl pdo_pgsql pgsql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY site.conf /etc/nginx/sites-enabled/default.conf
WORKDIR /app
COPY . /app
RUN cd /app/root && cp .env.testing .env
RUN composer install