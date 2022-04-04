SHELL=/bin/bash
UID=$(shell id -u)
SERVICES = nginx php_8.1 node mysql

.DEFAULT: help

help:  ## Display command list
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-10s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)

init: build prepare-backend install-certs prepare-certs## Initialize the project

privilege: ## add user to docker group. After run "exec su -l $USER"
	sudo gpasswd -a ${USER} docker

usermode: ## Set usermode
	sudo usermod -a -G docker ${USER}

run: ## Run the project
	@docker-compose up -d
	@echo "Please wait for the Node start. It will take about 1 minute."

stop: ## Stop the project
	@docker-compose stop

restart: stop run ## Restart project

build:  ## Build containers
	@docker-compose build --parallel --progress plain

clear:  ## Clear all! Be careful to use this command!
	@docker-compose down
	@docker rm -f $$(docker ps -a -q)
	@docker volume rm $(docker volume ls -q)

prepare-backend: ### Preparing backend for launch
	@docker-compose up -d --no-deps php_8.1
	@docker-compose exec php_8.1 sh -c 'which composer && cd /var/www/catalog && composer install && chown ${UID}:${UID} vendor/ -R || exit 0'
	@docker-compose exec php_8.1 sh -c 'cd /var/www/catalog && php artisan key:generate || exit 0'
	@docker-compose exec php_8.1 sh -c 'chown -R www-data:www-data storage/ || exit 0'
	@docker-compose stop php_8.1

nginx-restart: ## Restart nginx
	@docker-compose stop nginx
	@docker-compose up -d --no-deps nginx

install-certs: ## Install mkcert
	sudo apt-get install libnss3-tools
	wget https://github.com/rfay/mkcert/releases/download/v1.4.1-alpha1/mkcert-v1.4.1-alpha1-linux-amd64 -O ./bin/mkcert
	chmod +x ./bin/mkcert

prepare-certs: ## Prepare ssl certificates
	chmod +x ./bin/mkcert \
	[ -f ./bin/mkcert ] || ./bin/mkcert -install && ./bin/mkcert -install catalog-front.dev && ./bin/mkcert -install catalog.dev && \
	sudo chown ${USER}:${USER} ./docker/nginx/ -R && \
	mkdir -p ./docker/nginx/ssl/catalog-front.dev/ && \
	mkdir -p ./docker/nginx/ssl/catalog.dev/ && \
	mv catalog.dev.pem ./docker/nginx/ssl/catalog.dev/fullchain.pem && \
	mv catalog.dev-key.pem ./docker/nginx/ssl/catalog.dev/privkey.pem && \
	mv catalog-front.dev.pem ./docker/nginx/ssl/catalog-front.dev/fullchain.pem && \
    mv catalog-front.dev-key.pem ./docker/nginx/ssl/catalog-front.dev/privkey.pem

uid: ## change www-data uid in all containers to current user
	@for s in $(SERVICES); do \
		docker-compose up -d --no-deps $$s; \
		docker-compose exec $$s bash -c 'if [[ ${UID} -ne 0 ]]; then usermod -u ${UID} www-data; fi'; \
		docker-compose stop $$s; \
	done


db-prepare: db-create db-migrate## Prepare database

db-create: ##Create database
	@docker-compose up -d --no-deps mysql
	@docker-compose exec mysql sh -c 'mysql -uroot -proot -e "CREATE DATABASE catalog CHARACTER SET =utf8 COLLATE = utf8_general_ci" || exit 0'
	@docker-compose stop mysql

db-migrate: ## Start migrations
	@docker-compose up -d --no-deps mysql
	@docker-compose up -d --no-deps php_8.1
	@docker-compose exec php_8.1 sh -c 'cd /var/www/catalog && php artisan migrate || exit 0'
	@docker-compose stop mysql
	@docker-compose stop php_8.1