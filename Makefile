EXEC = docker-compose exec -T php
DB = docker-compose exec db
DBT = docker-compose exec -T db

GREEN = $$(tput setaf 2)
YELLOW = $$(tput setaf 3)
RESET = $$(tput sgr0)

all: help

help:                  #~ Show this help
	@fgrep -h "#~"  $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e "s/^\([^:]*\):/${GREEN}\1${RESET}/;s/#~r/${RESET}/;s/#~y/${YELLOW}/;s/#~ //"

#~y
#~ Project Setup
#~ ________________________________________________________________
#~r

install:               #~ Install and start the project
install: build start

build:                 #~ Build docker containers
	docker-compose build

start:                 #~ Start the docker containers
	docker-compose up -d

stop:                  #~ Stop the docker containers
	docker-compose stop

clean:                 #~ Clean the docker containers
clean: stop
	docker-compose rm

destroy:               #~ Remove all docker images
destroy: stop
	docker-compose down --rmi all

# hack to insure that mysql is up.
sleep:
	sleep 3

.PHONY: install build start stop clean destroy sleep

#~y
#~ PHP
#~ ________________________________________________________________
#~r

console:               #~ Open the bash console in php docker
	docker-compose run -p 8081:8081 -u www-data php bash

console-root:          #~ Open the bash console in php docker with root user (Take care).
	docker-compose exec php bash

.PHONY: console console-root

#~y
#~ MariaDB
#~ ________________________________________________________________
#~r

console-db:            #~ Open the console in mariadb docker
	$(DB) bash

export-db:             #~ Backup the database
	$(DBT) bash -c 'mysqldump -u root --password=root testapi | bzip2 > /var/lib/mysql/backup/testapi.sql.bz2'

.PHONY: console-db export-db