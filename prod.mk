.PHONY: setup

setup: composer.phar .env
	./composer.phar install --no-dev --prefer-dist --optimize-autoloader --no-interaction

composer.phar:
	./script/setup-composer.sh

.env:
	cp .env.example .env

