# MY_CINEMA
## 1. Structure 
- `./includes/dbh.inc.php` : Connection à la base de donnée (penser à changer le mot de passe)
- `./sources/` : Toutes les fonctions PHP qui intéragissent avec la BDD
- `./functions/` : Permet l'appel `_GET` de toutes les fonctions PHP avec le JS
- `./script/` : Scripts JS qui intéragissent sur les pages HTML en appelamt les fonctions PHP
- `./pages/` : Contient les pages bonus.
- `./css/` : Fichiers CSS
- `./fonts/` : Fonts utilisées sur la page
   
## 2. Pages
- `http://localhost:8080/` : Page de base qui permet de traiter les utilisateurs, les films et les sessions.
- `http://localhost:8080/pages/user-page/login.php` : Page de connexion des utilisateurs.
- `http://localhost:8080/pages/user-page/signin.php` : Page d'inscription des utilisateurs.
- `http://localhost:8080/pages/user-page/userPage.php` : Page utilisateur.
- `http://localhost:8080/pages/user-page/parameter.php` : Page de paramètres utilisateur.
- `http://localhost:8080/pages/user-page/moviePage.php` : Page d'information sur un film et ses séances.

## 3. Autre
- La base de donnée a été légerement modifié en intégrant une colonne password à la table user, afin de permettre aux utilisateur de se connecter. La base de donnée est accessible à `./includes/my_cinema.sql`.
- L'aspect visuel brut et 'sale' du site est voulu.
