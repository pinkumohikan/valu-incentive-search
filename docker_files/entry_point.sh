#!/bin/sh

crond

php-fpm &

nginx -g 'daemon off;'
