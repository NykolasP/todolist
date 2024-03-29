# Le projet Todolist

Ce projet est une Todolist basique avec une configuration Docker pour initialiser le projet ainsi que des tests unitaires, d'acceptance et fonctionnels.

## Les outils

### Docker
- Image PHP : php:8.1-fpm-alpine
- Image MySQL : mysql:latest
- Image Nginx : nginx:latest

### Composer
- symfony/dotenv : "^6.4"
- codeception/codeception : "^5.1"
- codeception/module-phpbrowser : "*"
- codeception/module-asserts : "*"
- codeception/module-db : "^3.1"

# Installation

Exécutez "docker compose up -d" pour créer les conteneurs.

## Variables d'environnement

### Les fichiers .env

Créez un fichier .env à la racine du projet et dans le dossier "src", avec "localhost" comme hôte dans le .env situé dans le dossier "src".

### Variables
- MYSQL_ROOT_PASSWORD
- DB_DATABASE
- DB_USER
- DB_PASSWORD
- DB_HOST
- DB_PORT
- DB_CHARSET
- DB_ENGINE

# Lancement des tests

Accédez au dossier "src" et lancez "vendor/bin/codecept run".
