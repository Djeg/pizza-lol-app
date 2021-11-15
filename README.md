# Library Shop

Library Shop est un petit site web de commerce de vente
de livres entre particuliers.

## Cahier des charges

Library Shop est composé de plusieurs fonctionalités que vous
pouvez implémenter dans l'ordre que vous souhaitez :

1. Mettre en place un projet symfony avec la commande :
   `symfony new lib-shop --full`

2. Configurer une base de données en éditant le fichier
   `.env`

3. Installer alice avec : `composer install hautelook/alice-bundle`

4. Créer une entité « Utilisateur » avec la commande `symfoy console make:auth`

5. Créer une entité « Catégorie » avec les champs suivants :

    - titre (string)

6. Créer une entité « Auteur » avec les champs suivants :

    - nom
    - prenom
    - description

7. Installer et configurer l'extension suivante pour gérer les dates
   de création et de mise à jour :

    - [Documentation de l'extension](https://symfony.com/bundles/StofDoctrineExtensionsBundle/current/index.html)
    - Installation : `composer require stof/doctrine-extensions-bundle`
    - [Activer l'extension "timestampable"](https://symfony.com/bundles/StofDoctrineExtensionsBundle/current/configuration.html#activate-the-extensions-you-want)

8. Créer une entité « Livre » avec les champs suivant :

    - titre (string)
    - description (text)
    - image (string)
    - date de création (datetime)
    - date de mise à jour (datetime)
    - prix (float)
    - category (relation)
    - auteur (relation)
    - revendeur (relation vers Utilisateur)

9. Créer un espace d'administration pour créer, supprimer, lister et
   mettre à jour des livres, auteurs et catégories.
   Vous pouvez utiliser la commande `symfony console make:crud`

10. Vous pouvez créer un fichier de fixtures contenant des utilisateurs,
    catégories, auteurs et livres.

11. Créer une page d'accueil qui affiche les 10 derniers livres,
    les 10 dernières catégories et les 10 derniers auteurs.

12. Créer une page de rechercher ('/rechercher') avec un formulaire afin
    de rechercher des livres par : titre, auteur, revendeur,
    prix minimum, prix maximum et triable
    par : date de mise à jour, id, prix

13. Créer une page qui affiche un livre (titre, description, prix son
    auteur, son revendeut etc ...)

14. Créer une page qui affiche un auteur

15. Relier la page d'accueil avec la page d'affichage d'un livre et d'un
    auteur et rediriger vers la page de recherche lors d'un clique
    sur une catégorie.

16. Créer une page de connexion (graçe à la commande
    `symfony console make:auth`)

17. Ajouter la possibilité pour un Utilisateur de créer et revendre un livre

18. Ajouter la possibilité pour un Utilisateur de rajouter des
    livres dans un Panier

19. Ajouter la possibilité de valider un panier avec un faux formulaire
    de carte bleu. Un fois le panier acheter, l'utilisateur devrait
    avoir accès à ces dernières commandes sur le site
