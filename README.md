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


4. Arrêter l'application, 

Pour arrêter les conteneurs, exécutez la commande suivante dans le répertoire contenant le fichier docker-compose.yml :

````bash
sudo docker-compose down
````


## Fonctionnement et logique de l'application 

Cette application web est un service destiné à la santé des utilisateurs.
Elle se présente d'abord par une page de connexion et d'inscription permettant à l'utilisateur, une fois enregistré, d'accéder au site.
Une fois la connexion effectuée, l'utilisateur a accès à un tableau de bord présentant ses options.

L'utilisateur peut :

- Accéder à son espace personnel
- Remplir un formulaire de pré-rendez-vous
- Consulter les messages (non configurés)
- Se déconnecter

Depuis son espace personnel, l'utilisateur peut télécharger des fichiers médicaux, tels que des ordonnances.
Depuis le formulaire de pré-rendez-vous, l'utilisateur peut renseigner des informations relatives à sa prise de rendez-vous.

Une section du site est également prévue pour le côté médecin, mais elle est encore en cours de construction.