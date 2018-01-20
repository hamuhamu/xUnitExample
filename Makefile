.PHONY: test
PHP=$(shell which php)

test:
	$(PHP) xunit.php
