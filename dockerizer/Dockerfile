FROM webdevops/php-nginx:8.2-alpine

COPY ./dockerizer/php.ini /opt/docker/etc/php/php.ini
COPY ./dockerizer/vhost.conf /opt/docker/etc/nginx/vhost.conf
COPY ../composer.json ../composer.lock /app/
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY . /app/
RUN chown -R www-data:www-data /app/
RUN chmod 777 -R -v /app/storage/
RUN cd /app/ && composer install
