# Library Shop

Un site de commerce de vente de livres.

## L'installation

1. Télécharer (ou cloner) le projet et l'extraire
   dans le répertoire de votre choix.

2. Ouvrir vscode à la racine du projet.

3. Installer les dépendances : `composer install`

4. Configurer votre base de données dans le fichier `.env`

5. Créer la base de données avec la commande : `symfony console doctrine:database:create`

6. Créer le schéma avec la commande : `symfony console doctrine:schema:update --force`

7. Insérer les fixtures dans la base de données avec : `symfony console hautelook:fixtures:load`

8. Démarer le server symfony : `symfony server:start`

## Les fonctionalités

1. C'est la possibilité sur un epace d'administration
   de lister, creer, mettre à jour et supprimer des
   utilisateurs.

2. Mettre en place de l'authentification (login, logout)

3. Restreindre l'accès à l'espace d'administration aux
   utilisateurs avec le ROLE_ADMIN (créer des utilisateur
   via des fixtures, vous pouvez crypter un mot
   de passe graçe à la commande : `symfony console security:hash-password`)

4. Creer dans l'espace d'admin, la possibilité de CRUD (Create, Retrieve
   , Update, Delete) des genres. Vous pouvez aussi les rajouter
   dans les fixtures

5. Créer dans l'espace d'admin, la possibilité de CRUD des autheurs.
   Vous aussi pouvez les rajouter dans les fixtures.

6. Créer dans l'espace d'admin, la possibilité de CRUD des livres.
   Vous pouvez aussi rajouter des fixtures.

7. Créer une page d'accueil avec un menu, la liste des 10 derniers
   livres ajouter. La liste des 10 derniers genres. La liste des
   10 derniers auteurs (Prévoir un footer).

8. Créer une page qui permet d'afficher un Livre (son titre, sa description,
   son image, son prix etc ...)

9. Créer une page qui permet d'afficher un auteur (nom, description, ses 20 derniers
   livres etc ...)

10. Ajouter une page de recherche des livres:

    - Par nom
    - Par genre
    - Par auteur
    - Trier par : Date de création, Nom

11. Dans la page d'accueil, lors du clique sur un genre on redirige vers la
    recherche avec le genre de préremplie.

12. La possibilité de rajouter un livre au panier (accessible qu'au personne
    connécté). Nous pouvons ajouter un bouton "Ajouter au panier" sur la
    page d'un livre, et aussi directement depuis la liste.

13. Validation du panier, et passage de la commande (vous pouvez mettre
    place au faux formulaire de paimement par carte).

14. Je devrais pouvoir retrouver dans l'application la liste de toutes
    mes commandes.

15. Mettre en place un système de commentaires et de notes pour les livres
    et les auteurs.
