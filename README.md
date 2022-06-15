# app_stock_symf

********** IMPORTANT


AVANT DE POUVOIR LANCER LE PROJET VEUILLEZ SUIVRE CES DIFFERENTES ETAPES

__installer le dossier vendor : 

composer install

__installer le chargeur de templates asset

composer require symfony/asset

__mettre a jour le dossier public 

 - créer un dossier nommé  "build" à l'intérieur du dossier "public"
 - déplacer tous les fichiers avec l'extension ".js" et ".css" se trouvant dans le dossier "public" à l'intérieur du dossier "build"

__création de la base de données

vérifier à l'intérieur du fichier .env le nom de la base de données puis créer dans Mysql

__intégrer les migrations

pour se faire taper la commande suivante:

php bin/console doctrine:migrations:migrate

__présentation de la maquette
 
 il y'a un dossier nommé canva avec la maquette du projet ainsi que sa présentation.
