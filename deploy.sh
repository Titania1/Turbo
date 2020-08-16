#!/bin/sh
cd Turbo
git pull
composer install --optimize-autoloader --no-dev
art migrate
art admin:create
art db:seed --class=RoleSeeder
