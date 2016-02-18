.PHONY: test test-coverage test-coverage-html test-coverage-clover test-unit test-unit-coverage test-unit-coverage-html test-unit-coverage-clover test-functional test-functional-coverage test-functional-coverage-html test-functional-coverage-clover install

# tests
test:
	@./vendor/bin/phpunit

test-coverage:
	@./vendor/bin/phpunit --coverage-text

test-coverage-html:
	@./vendor/bin/phpunit --coverage-html ./tests/report/html

test-coverage-clover:
	@./vendor/bin/phpunit --coverage-clover=./tests/report/coverage.clover

# unit tests
test-unit:
	@./vendor/bin/phpunit --testsuite unit

test-unit-coverage:
	@./vendor/bin/phpunit --testsuite unit --coverage-text

test-unit-coverage-html:
	@./vendor/bin/phpunit --testsuite unit --coverage-html ./tests/report/unit/html

test-unit-coverage-clover:
	@./vendor/bin/phpunit --testsuite unit --coverage-clover=./tests/report/unit/coverage.clover

# functional tests
test-functional:
	@./vendor/bin/phpunit --testsuite functional

test-functional-coverage:
	@./vendor/bin/phpunit --testsuite functional --coverage-text

test-functional-coverage-html:
	@./vendor/bin/phpunit --testsuite functional --coverage-html ./tests/report/functional/html

test-functional-coverage-clover:
	@./vendor/bin/phpunit --testsuite functional --coverage-clover=./tests/report/functional/coverage.clover

# build
install:
	@composer install
