FROM php:7.0-fpm-alpine
LABEL Maintainer="Young Martin 45 <young.martin45@gmail.com>" \
      Description="Nginx & php-fpm 7.0 based on Alpine Linux."

# Install nginx & gettext (envsubst)
# Create cachedir and fix permissions
RUN apk add --no-cache tini\
    gettext \
    nginx supervisor curl && \
    mkdir -p /var/cache/nginx && \
    chown -R www-data:www-data /var/cache/nginx && \
    chown -R www-data:www-data /var/lib/nginx && \
    chown -R www-data:www-data /var/tmp/nginx && \
    rm -rf /etc/nginx/nginx.conf && \
    rm -rf /usr/local/etc/php-fpm.d/zz-docker.conf && \
    mkdir -p /www && \
    chown -R www-data:www-data /www

# # Install a golang port of supervisord
# COPY --from=ochinchina/supervisord:latest /usr/local/bin/supervisord /usr/bin/supervisord

# # Runtime env vars are envstub'd into config during entrypoint
ENV SERVER_NAME="localhost"
ENV SERVER_ALIAS=""
ENV SERVER_ROOT=/www

# Alias defaults to empty, example usage:
# SERVER_ALIAS='www.example.com'

# COPY ./supervisord.conf /supervisord.conf
COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf
# COPY ./php-fpm-www.conf /etc/php7/php-fpm.d/www.conf
COPY ./php-fpm-www.conf /usr/local/etc/php-fpm.d/www.conf
# COPY ./php-fpm-www.conf /usr/local/etc/php-fpm.d/zz-docker.conf
COPY ./nginx.conf.template /nginx.conf.template
COPY ./docker-entrypoint.sh /docker-entrypoint.sh

RUN chmod 777 /docker-entrypoint.sh
# # Nginx on :80
EXPOSE 80
WORKDIR /www
ENTRYPOINT ["tini", "--", "/docker-entrypoint.sh"]