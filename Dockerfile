FROM php:7.2-cli-alpine3.8

MAINTAINER Youri hideOut <youri@youhide.com.br>

RUN apk add --no-cache mongodb autoconf g++ make openssl-dev libmcrypt-dev

RUN pecl install mongodb-1.5.2
RUN docker-php-ext-install bcmath sockets
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

WORKDIR /ultimaphp
COPY . ./
CMD [ "php", "startserver.php" ]

EXPOSE 2593
