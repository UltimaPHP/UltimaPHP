FROM php:7.2-cli-alpine3.8

MAINTAINER Youri hideOut <youri@youhide.com.br>

RUN apk add mongodb autoconf g++ make openssl-dev libmcrypt-dev

RUN mkdir -p /data/db
RUN mongod --fork --logpath /tmp/mongod.log
RUN sleep 5
RUN cat /tmp/mongod.log
RUN mongo redirect --eval 'db.createCollection("ultimaphp")'

# RUN wget -O /tmp/UOLocation.zip https://ultimaphp.nyc3.digitaloceanspaces.com/ultimaphpmuls.zip

WORKDIR /ultimaphp
COPY . ./
# RUN mkdir UOLocation
# RUN unzip /tmp/UOLocation.zip -d ./UOLocation
CMD [ "php", "startserver.php" ]

EXPOSE 2593
