# Prérequis

Ce projet nécessite PHP 8.1 ou une version plus récente.

# Installation du projet

git clone

composer install

yarn install

yarn encore dev --watch

# Initialisation base de données

bin/console doctrine:database:create

bin/console doctrine:migrations:migrate

# Lancement de l'application 

symfony server:start

