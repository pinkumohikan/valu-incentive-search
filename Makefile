SERVICE_LABEL=com.pinkumohikan.valu-incentive-search.service

.PHONY: dev/* prod/* sh tinker exec

dev/up:
	cp .env.dev .env
	docker-compose -f docker-compose.yml -f docker-compose-dev.yml up -d --build
	$(MAKE) exec cmd="make -f docker-internal.mk setup"
	$(MAKE) exec cmd="php artisan migrate --force"

dev/down:
	docker-compose -f docker-compose.yml -f docker-compose-dev.yml down


prod/up: .env.prod
	cp .env.prod .env
	docker-compose -f docker-compose.yml up -d --build
	$(MAKE) exec cmd="php artisan migrate --force"

prod/down:
	docker-compose -f docker-compose.yml down


sh:
	$(MAKE) exec docker-opt="-it" cmd="sh"

tinker:
	$(MAKE) exec docker-opt="-it" cmd="php artisan tinker"

exec: docker-opt=
exec: cmd=
exec:
	docker exec $(docker-opt) $(shell docker ps -q --filter "label=$(SERVICE_LABEL)=app") $(cmd)

.env.prod:
	echo "[ACTION REQUIRED] prepare .env.prod file." && exit 1
