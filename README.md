# README - Exécution de l'application web

Ce guide décrit comment installer et exécuter santhe en utilisant Docker.

## Prérequis

Avant de commencer, assurez-vous d'avoir Docker et Docker Compose installés sur votre machine. Si vous ne les avez pas encore installés, vous pouvez suivre les instructions sur les sites officiels de Docker :

- [Installation de Docker](https://docs.docker.com/get-docker/)
- [Installation de Docker Compose](https://docs.docker.com/compose/install/)

## Étapes pour exécuter l'application

1. **Récupérer l'image Docker**

   Utilisez la commande suivante pour récupérer l'image Docker de l'application :

````bash
   sudo docker pull guillaumerobin9/sansthe:latest
   ````

2. **Démarrer l'application avec Docker Compose**

Dans le répertoire où se trouve le fichier docker-compose.yml, exécutez la commande suivante pour construire l'image et démarrer les conteneurs :

````bash
sudo docker-compose up --build
````

3. Accéder à l'application

Une fois les conteneurs démarrés, vous pouvez accéder à l'application via votre navigateur en vous connectant au port localhost:81 :


Arrêter l'application
Pour arrêter les conteneurs, exécutez la commande suivante dans le répertoire contenant le fichier docker-compose.yml :

````bash
sudo docker-compose down
````