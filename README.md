----Instruction pour run le projet laravel----

1-Communication avec la base de données

    - Se connecter à votre server mysql 
            - sudo mysql -u root -p
  
    - Sourcer le fichier hozondb_setup.sql (qui se situe a la racine de notre dépot github) dans votre serveur mysql 
            - SOURCE /VOTRE_CHEMIN/hozondb_setup.sql;

    Vous êtes maintenant connecté à la base de données

2-Lecture du projet Laravel en local

    Certains dossiers et fichiers ne sont pas sur le github pour des raisons de sécurité. Voici la marche à suivre:
        - Dans le terminal placez vous dans le dossier du projet laravel (VOTRE_CHEMIN/hozon) et effectuez les commandes suivantes:

            - composer install
            - npm install 
  
            (si vous n'avez ces commandes suivez les insctrutions pour installer npm et/ou composer)

            - Copiez le fichier .env.example et le nommer .env 
                    - cp .env.example .env

            - Dans ce fichier .env, remplacez les mentions suivantes :

                DB_CONNECTION=mysql
                DB_HOST=127.0.0.1
                DB_PORT=3306
                DB_DATABASE=Hozondb
                DB_USERNAME=hozon_admin
                DB_PASSWORD=Epitech.90

            - Faire la commande: php artisan key:generate

            - Migrer les tables vers la base de données: php artisan migrate:fresh

            - Remplir les tables: php artisan db:seed 

            - Pour finir lancez le server: php artisan serve 