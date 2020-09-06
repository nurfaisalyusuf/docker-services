FROM youngmartin45/nginx-phpfpm-ext:7.3

LABEL Maintainer="Young Martin 45 <young.martin45@gmail.com>" \
    Description="Nginx & php-fpm 7.3 with extension based on Alpine Linux."

RUN apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS \ 
        && pecl install redis \
        && docker-php-ext-enable redis \
        && apk del .phpize-deps

# modify www-data user to have id 1000
    RUN apk add \
    --no-cache \
    --repository http://download.nus.edu.sg/mirror/alpine/edge/community/ --allow-untrusted \
    --virtual .shadow-deps \
    shadow \
    && usermod -u 1000 www-data \
    && groupmod -g 1000 www-data \
    && apk del .shadow-deps \
    && rm -rf /var/cache/apk/* \
    && php -m
