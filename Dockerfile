FROM caseyfw/php
RUN apk --update --no-cache add php7-xml
WORKDIR /web
COPY composer.lock ./
COPY composer.json ./
RUN composer install
COPY . ./
