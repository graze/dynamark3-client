.PHONY: test test-coverage test-coverage-html test-coverage-clover test-unit test-unit-coverage test-unit-coverage-html test-unit-coverage-clover test-functional test-functional-coverage test-functional-coverage-html test-functional-coverage-clover install

# Setting up

setup: ## Install dependencies and set up example conf file
	@docker-compose run --rm composer install

# Testing

test: ## Run all tests
test: test-coverage test-unit test-unit-coverage test-functional test-functional-coverage

# Coverage tests
test-coverage: ## Run coverage tests
	@docker-compose run --rm php-55 ./vendor/bin/phpunit --coverage-text

test-coverage-html:
	@docker-compose run --rm php-55 ./vendor/bin/phpunit --coverage-html ./tests/report/html

test-coverage-clover:
	@docker-compose run --rm php-55 ./vendor/bin/phpunit --coverage-clover=./tests/report/coverage.clover

# Unit tests
test-unit: ## Run unit tests
	@docker-compose run --rm php-55 ./vendor/bin/phpunit --testsuite unit

test-unit-coverage:
	@docker-compose run --rm php-55 ./vendor/bin/phpunit --testsuite unit --coverage-text

test-unit-coverage-html:
	@docker-compose run --rm php-55 ./vendor/bin/phpunit --testsuite unit --coverage-html ./tests/report/unit/html

test-unit-coverage-clover:
	@docker-compose run --rm php-55 ./vendor/bin/phpunit --testsuite unit --coverage-clover=./tests/report/unit/coverage.clover

# Functional tests
test-functional: ## Run functional tests
	@docker-compose run --rm php-55 ./vendor/bin/phpunit --testsuite functional

test-functional-coverage:
	@docker-compose run --rm php-55 ./vendor/bin/phpunit --testsuite functional --coverage-text

test-functional-coverage-html:
	@docker-compose run --rm php-55 ./vendor/bin/phpunit --testsuite functional --coverage-html ./tests/report/functional/html

test-functional-coverage-clover:
	@docker-compose run --rm php-55 ./vendor/bin/phpunit --testsuite functional --coverage-clover=./tests/report/functional/coverage.clover

# Code sniffer
lint: ## Run phpcs against the code.
	@docker-compose run --rm php-55 vendor/bin/phpcs -p --warning-severity=0 src/ tests/

lint-fix: ## Run phpcbf against the code.
	@docker-compose run --rm php-55 vendor/bin/phpcbf -p src/

.SILENT: help
help: ## Show this help message
	set -x
	echo "Usage: make [target] ..."
	echo ""
	echo "Available targets:"
	egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'
