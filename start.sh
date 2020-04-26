#!/bin/bash
docker-compose up -d
docker exec -it web composer install
docker exec -it web php vendor/phalcon/devtools/phalcon.php migration run