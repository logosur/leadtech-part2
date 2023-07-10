#!/bin/bash

install:
	curl -sS https://get.symfony.com/cli/installer | bash
	php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
	composer install
	symfony console doctrine:database:create --if-not-exists
	symfony console doctrine:migrations:migrate -n
	#symfony console doctrine:fixtures:load
	symfony console doctrine:database:create --if-not-exists --env=test
	symfony console doctrine:migrations:migrate -n --env=test
	#symfony console doctrine:fixtures:load --env=test
run:
	symfony serve
