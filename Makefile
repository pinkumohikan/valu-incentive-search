
.PHONY: up down

up:
	docker-compose -f docker-compose.yml -f docker-compose-dev.yml up -d --build

down:
	docker-compose -f docker-compose.yml -f docker-compose-dev.yml down

sh:
	docker exec -it $(shell docker ps -q --filter "ancestor=valu-incentive-search_app") sh

tinker:
	docker exec -it $(shell docker ps -q --filter "ancestor=valu-incentive-search_app") php artisan tinker
