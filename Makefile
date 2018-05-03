APP_IMAGE_NAME=valu-incentive-search_app

.PHONY: dev/* prod/* sh tinker exec

dev/up:
	cp .env.dev .env
	docker-compose -f docker-compose.yml -f docker-compose-dev.yml up -d --build
	$(MAKE) exec cmd="php artisan migrate"

dev/down:
	docker-compose -f docker-compose.yml -f docker-compose-dev.yml down


prod/up: .env.prod
	cp .env.prod .env
	docker-compose -f docker-compose.yml up -d --build
	$(MAKE) exec cmd="php artisan migrate"

prod/down:
	docker-compose -f docker-compose.yml down


sh:
	$(MAKE) exec cmd="sh"

tinker:
	$(MAKE) exec cmd="php artisan tinker"

exec: cmd=
exec:
	docker exec -it $(shell docker ps -q --filter "ancestor=$(APP_IMAGE_NAME)" --last 1) $(cmd)

.env.prod:
	echo "[ACTION REQUIRED] prepare .env.prod file." && exit 1
