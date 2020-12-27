#!/bin/sh
cd Turbo
git checkout -- . && git reset --hard HEAD && git clean -df
git pull
composer install --optimize-autoloader --no-dev
art migrate
art admin:create
art db:seed --class=RoleSeeder
