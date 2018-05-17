#!/bin/bash
# Run project's unit-tests by phpUnit

echo "Running unit-tests by phpUnit..."
bash -c "vendor/bin/phpunit --verbose --stderr --colors --configuration phpunit.xml tests";