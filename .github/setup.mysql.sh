#!/usr/bin/env bash

CURRENT_DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
TRAVIS_BUILD_DIR="${TRAVIS_BUILD_DIR:-$(dirname $(dirname $CURRENT_DIR))}"

echo -e "Create MySQL database..."
mysql -h 127.0.0.1 -u root -e "CREATE DATABASE IF NOT EXISTS sign charset=utf8mb4 collate=utf8mb4_unicode_ci;"
cat "${TRAVIS_BUILD_DIR}/mysql.sql" | mysql -h 127.0.0.1 -u root sign

echo -e "Done\n"

wait
