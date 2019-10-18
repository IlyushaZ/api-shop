up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build

execute-bash:
	docker-compose exec php bash

first-init:
	build up

