up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build

execute-bash:
	docker-compose exec php bash

composer-install:
	docker-compose exec php composer install

migrations:
	docker-compose exec php php bin/console d:m:m --no-interaction

run-tests:
	docker-compose exec php php bin/phpunit

first-init: build up composer-install migrations

