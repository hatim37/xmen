# Agence des XMEN

Ce projet est une application créer dans le cadre d'une formation de développeur web.
Elle a été conçu avec le framework Symfony 6.0 et php 8.1.
Cette application permet de présenter une liste de mission fictive de super-héros issu de la saga des X-Men.
Un formulaire de connexion permet à un administrateur de configurer tous les détails d'une mission.

----------------------

## Instructions  
### Pré-requis

- composer version 2.5.1
- php 8.1


### Déploiement local 

- Récuperer le projet github en local :  

    Depuis votre terminal taper :
    
         git clone https://github.com/hatim37/xmen.git


- Installer les dépendances, depuis le terminal :

        composer install


- la clé APP_SECRET n'est pas fourni, pour génerer une Clé dans votre .env taper la commande suivante dans votre terminal :

        php bin/console secret:regenerate-app-secret .env


- Configurer votre fichier .env pour se connecter à la base de donnée: 

        DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=15&charset=utf8"


- Création de la base de donnée :

        php bin/console d:d:c



- Création des tables dans la base donnée :

        php bin/console d:m:m


- En environement "dev" vous pouvez génerer des fixtures : 

        php bin/console doctrine:fixtures:load


- Compte administrateur :

    - Vous pouvez créer un compte administrateur pour vous connectez et gérer la base de donnée. Saisir la commande :  

            php bin/console app:create-administrator

        Puis renseigner un nom, un prénom, un email et un mot de passe.
            

------------------------------

*Mes remerciments à tous les formateurs de studi-school qui déploient beaucoup d'efforts pour nous fournir des cours de qualité et nous transmettre les savoirs-faires pour réussir notre projet professionnelle*


