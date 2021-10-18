# Exercice Pizzeria

Faire une application de pizzeria, cette application
doit contenir les pages suivantes :

-   Une page d'accueil qui affiche les dernières pizzas
-   Une page de création de pizza avec un formulaire que
    l'on peut soumettre afin de créer une pizza (attention
    à bien utiliser la méthode POST)
-   Une page de recherche avec les dernières pizzas
    ainsi qu'un formulaire de recherche (par nom de pizza et/ou
    par son prix)
-   Pouvoir cliquer sur une pizza et se rendre sur sa page
    d'affichage. Sur cette page je devrais pouvoir modifier
    la pizza graçe à un formulaire.
-   BONUS : Pouvoir supprimer une pizza

1. Créé une nouvelle application
2. N'hésitez pas à consulter la documentation de symfony

```
# Consulter le dossier en cours
pwd

# Lister tout les fichiers et dossier du répertoire
ls

# se déplacer de répertoire
cd NomDuDossier
# retour en arrière
cd ..


# Créer une application symfony
symfony new leNomDuRepertoireDuProjet --full

# Lancer le server symfony
symfony server:start

# Créer une base de données
symfony console doctrine:database:create

# Supprimer une base de données
symfony console doctrine:database:drop --force

# Générer une entité
symfony console make:entity

# Mettrre à jour les tables de la BDD
symfony console doctrine:schema:update --force
```
