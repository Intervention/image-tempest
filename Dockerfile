FROM php:8.5-cli

# install dependencies
RUN apt update && apt install -y \
            libexif-dev \
            libpng-dev \
            libjpeg-dev \
            libicu-dev \
            libmagickwand-dev \
            git \
            zip \
            curl \
        && CPPFLAGS='-Dphp_strtolower=zend_str_tolower' pecl install imagick \
        && docker-php-ext-enable imagick \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install \
            fileinfo \
            gd \
            exif \
        && apt-get clean


# install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# setup entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
