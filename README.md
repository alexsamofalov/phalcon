# Phalcon REST/MVC system

## Stack

* PhalconPHP v3.4
* MySQL 8
* Redis
* Docker
* Composer
* Gulp

## Run project

* docker-compose up

## Stop project

* docker-compose stop

## Build project

* docker exec -it web composer install

## Project local URL

* API: http://localhost:8081/
* MVC: http://localhost:8082/
* Adminer: http://localhost:8083/

## Commands

SSH into container
* docker exec -it {containerName} /bin/bash

Run migration
* docker exec -it web php vendor/phalcon/devtools/phalcon.php migration run

Create migration
* docker exec -it web php vendor/phalcon/devtools/phalcon.php migration generate --table={tableName}

Generate model
* docker exec -it web php vendor/phalcon/devtools/phalcon.php model --name={tableName}

Reset cache
* docker exec -it web php cli.php cache reset

Run codeception test
* docker exec -it web vendor/codeception/codeception/codecept run