
.PHONY: up down

up:
	docker-compose -f docker-compose.yml -f docker-compose-dev.yml up -d --build
	$(MAKE) exec cmd="php artisan migrate"

down:
	docker-compose -f docker-compose.yml -f docker-compose-dev.yml down

sh:
	$(MAKE) exec cmd="sh"

tinker:
	$(MAKE) exec cmd="php artisan tinker"

exec: cmd=
exec:
	docker exec -it $(shell docker ps -q --filter "ancestor=valu-incentive-search_app" --last 1) $(cmd)
