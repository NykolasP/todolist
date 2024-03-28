#!/bin/sh

# Exécute composer install
composer install

# Démarrage de PHP-FPM
exec php-fpm