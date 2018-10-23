FROM php:7.2-fpm-alpine

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.interned_strings_buffer=8'; \
        echo 'opcache.max_accelerated_files=4000'; \
        echo 'opcache.revalidate_freq=2'; \
        echo 'opcache.fast_shutdown=1'; \
        echo 'opcache.enable_cli=1'; \
        echo 'upload_max_filesize=10G'; \
        echo 'post_max_size=10G'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

ADD . /var/www/html

CMD ["php-fpm"]
