FROM mysql:5.7.23

RUN apt-get update && \
    apt-get install -y locales curl make && \
    rm -rf /var/lib/apt/lists/* && \
    echo "ja_JP.UTF-8 UTF-8" > /etc/locale.gen && \
    locale-gen ja_JP.UTF-8

ENV LC_ALL ja_JP.UTF-8

COPY ./config/my.cnf /etc/mysql/conf.d/my.cnf
