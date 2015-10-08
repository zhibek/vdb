#!/bin/bash

composer install --prefer-dist -vvv

vendor/bin/zf.php orm:schema-tool:update --force