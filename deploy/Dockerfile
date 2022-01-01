
FROM php:8.1.1-fpm

WORKDIR /var/dev

COPY ../ .

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - &&\
    apt-get update -y &&\
    apt-get install -y nodejs &&\
    rm -rf /var/lib/apt/lists/* &&\
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y \
        supervisor \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libicu-dev \
        ffmpeg \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl zip bcmath sockets \
    && docker-php-ext-install pcntl \
    && pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt-get install -y \
        exiftool \
    && docker-php-ext-configure exif \
    && docker-php-ext-install exif \
    && docker-php-ext-enable exif \
    && rm -rf /var/lib/apt/lists/*

CMD ["/sbin/init"]