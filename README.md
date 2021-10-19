# Book Store

Ceci est une application Symfony d'entrainement proposant
une e-commerce pour vendre des livres entre particulier.

## Installation

1. Télécharger et extraire le projet, ou bien
   utiliser `git clone`

2. Configurer votre base de données dans le fichier
   `.env`

3. Créer votre base de données : `symfony console doctrine:database:create`

4. Mettre en place le schéma : `symfony console doctrine:schema:update --force`

5. Démarrer le server : `symfony console server:start`
