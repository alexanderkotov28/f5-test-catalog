SHELL=/bin/bash
UID=$(shell id -u)

.DEFAULT: help

help:  ## Display command list
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-10s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)

init: build  ## Initialize the project

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