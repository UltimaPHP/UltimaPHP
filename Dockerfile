FROM php:7.2-cli-alpine3.8

MAINTAINER Youri hideOut <youri@youhide.com.br>

RUN apk add autoconf g++ make openssl-dev libmcrypt-dev
RUN pecl install mongodb \
    && docker-php-ext-install sockets \
    && docker-php-ext-enable mongodb


RUN wget -O /tmp/UOLocation.zip https://ultimaphp.nyc3.digitaloceanspaces.com/ultimaphpmuls.zip

WORKDIR /ultimaphp
COPY . ./
RUN mkdir UOLocation
RUN unzip /tmp/UOLocation.zip -d ./UOLocation
CMD [ "php", "startserver.php" ]

EXPOSE 2593
