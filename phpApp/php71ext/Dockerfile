FROM youngmartin45/nginx-phpfpm:7.1

LABEL Maintainer="Young Martin 45 <young.martin45@gmail.com>" \
      Description="Nginx & php-fpm 7.1 with extension based on Alpine Linux."

RUN apk add --no-cache --virtual .build-deps \
            # for all
            git \
            #for bzip
            bzip2-dev \
            #for curl
            curl-dev \
            # for intl extension
            gettext-dev \
            zlib-dev \
            fcgi \
            # for imagick
            autoconf \
            imagemagick-dev\
            libtool\
            # dev deps for gd
            freetype-dev \
            libjpeg-turbo-dev \
            libpng-dev \
            # for intl
            icu-dev \
            #for imap
            imap-dev \
            #for mysql
            mariadb-dev \
            # for mcrypt
            libmcrypt-dev \
            # for memcache
            libmemcached-dev \
            # for soap
            libxml2-dev \
            # for xsl
            libxslt-dev \
            # for ldap
            openldap-dev \
            # to build xdebug from PECL
            $PHPIZE_DEPS \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install \
        bcmath \
        bz2 \
        calendar \
        exif \
        gd \
        gettext \
        imap \
        ldap \
        mysqli \
        opcache \
        pdo \
        pdo_mysql \
        soap \
        xmlrpc \
        zip \
        && git clone https://github.com/tideways/php-profiler-extension.git /tmp/php-profiler-extension \
        && ( \
                cd /tmp/php-profiler-extension \
                && phpize \
                && ./configure \
                && make -j$(nproc) \
                && make install \
                && cd .. \
        ) \
        && rm -r /tmp/php-profiler-extension \
        && printf "\n" | pecl install imagick \
        && pecl install mcrypt-1.0.0 \
        && pecl install mongodb \
        && pecl install memcached \
        && docker-php-ext-enable opcache \
        imagick \
        mcrypt \
        mongodb \
        memcached \
        &&  echo -e "\n opcache.enable=1 \n opcache.enable_cli=1 \n opcache.memory_consumption=128 \n opcache.interned_strings_buffer=8 \n opcache.max_accelerated_files=4000 \n opcache.revalidate_freq=60 \n opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    # next will add runtime deps for php extensions
    # what this does is checks the necessary packages for php extensions Shared Objects
    # and adds those (won't be removed when .build-deps are)
    && runDeps="$( \
            scanelf --needed --nobanner --recursive \
                /usr/local/lib/php/extensions \
                | awk '{ gsub(/,/, "\nso:", $2); print "so:" $2 }' \
                | sort -u \
                | xargs -r apk info --installed \
                | sort -u \
        )" \
# Install msmtp - To Send Mails on Production & Development
    && apk add msmtp \
    && apk add --virtual .phpexts-rundeps $runDeps \
    && apk del .build-deps

# modify www-data user to have id 1000
    RUN apk add \
    --no-cache \
    --repository http://dl-3.alpinelinux.org/alpine/edge/community/ --allow-untrusted \
    --virtual .shadow-deps \
    shadow \
    && usermod -u 1000 www-data \
    && groupmod -g 1000 www-data \
    && apk del .shadow-deps
