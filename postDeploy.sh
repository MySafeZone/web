#!/bin/bash
php artisan optimize

php artisan migrate --force

php artisan route:clear

php artisan route:cache

php artisan config:clear

php artisan config:cache