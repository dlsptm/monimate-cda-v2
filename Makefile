phpcs:
	PHP_CS_FIXER_IGNORE_ENV=1 ./vendor/bin/php-cs-fixer fix \
	--verbose \
	--show-progress=dots \
	--config=.php-cs-fixer.dist.php \
	--allow-risky=yes

phpstan:
	php vendor/bin/phpstan analyse -c phpstan.dist.neon


db-drop:
	symfony console doctrine:database:drop --force

db-create:
	symfony console doctrine:database:create

db-diff:
	symfony console doctrine:migration:diff

db-migrate:
	symfony console doctrine:migration:migrate

entity:
	symfony console make:entity

form:
	symfony console make:form

controller:
	symfony console make:controller