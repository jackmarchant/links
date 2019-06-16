.PHONY: test

COMPOSE_PROJECT_NAME=app

COMPOSE_FILE?=docker-compose.yml

BASE_DIR=$(PWD)

COMPOSE_OVERRIDE_FILE?=
ifeq ($(COMPOSE_OVERRIDE_FILE),)
COMPOSE=docker-compose -p $(COMPOSE_PROJECT_NAME) -f $(COMPOSE_FILE)
else
COMPOSE=docker-compose -p $(COMPOSE_PROJECT_NAME) -f $(COMPOSE_FILE) -f $(COMPOSE_OVERRIDE_FILE)
endif

build:
	$(COMPOSE) build

up:
	$(COMPOSE) up -d $(COMPOSE_PROJECT_NAME)

down:
	$(COMPOSE) down

clean:
	$(COMPOSE) kill
	$(COMPOSE) rm --force

shell:
	docker exec -it $(COMPOSE_PROJECT_NAME) /bin/sh

init: build up shell

logs:
	docker logs -f $(COMPOSE_PROJECT_NAME)

test:
	docker exec $(COMPOSE_PROJECT_NAME) phpunit