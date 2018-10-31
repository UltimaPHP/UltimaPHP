FROM php:7.2-cli-alpine3.8

MAINTAINER Youri hideOut <youri@youhide.com.br>

RUN apk add autoconf g++ make openssl-dev libmcrypt-dev
RUN pecl install mongodb \
    && docker-php-ext-install sockets \
    && docker-php-ext-enable mongodb

RUN wget -O /tmp/UOLocation.zip https://ultimaphp.nyc3.digitaloceanspaces.com/ultimaphpmuls.zip

WORKDIR /ultimaphp
COPY . ./
RUN mkdir -p UOLocation
RUN unzip -f /tmp/UOLocation.zip -d ./UOLocation
# RUN DOCKER_IP=$(awk 'END{print $1}' /etc/hosts); sed -i -- "s/ip=127.0.0.1/ip=${DOCKER_IP}/g" ultimaphp.ini
# RUN sed -i -- 's/ip=127.0.0.1/ip=0.0.0.0/g' ultimaphp.ini
# RUN sed -i -- 's/host=127.0.0.1/host=mongo/g' ultimaphp.ini
CMD [ "php", "startserver.php" ]

EXPOSE 2593
