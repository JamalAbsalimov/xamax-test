build:
	docker compose build --no-cache
	docker compose up -d
	docker compose exec php-fpm composer install
	docker compose exec php-cli composer install --ignore-platform-req=ext-sockets
	docker compose exec php-cli php app.php do-nothing

up:
	docker compose up -d

in:
	docker compose exec php-fpm bash

in-cli:
	docker compose exec php-cli bash

down:
	docker compose down


exec:
	docker compose exec php-fpm

private-key:
	docker compose exec php-fpm openssl genpkey -algorithm RSA -out private.key -pkeyopt rsa_keygen_bits:2048

public-key:
	docker compose exec php-fpm openssl rsa -in private.key -pubout -out public.key