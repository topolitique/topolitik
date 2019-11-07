![topo](screenshot.png)

Thème Wordpress pour [topolitique.ch](http://topolitique.ch)
=====


## Structure :

**PHP**

-   En-tête : `header.php`
-   Bas de page : `footer.php`
-   Commentaires : `comments.php`
-   Index: `home.php` articles par section, on peut ajouter ou
    enlever des sections...
-   Catégorie:  `archive.php` : '/category/\<...>'
-   Article: `singular.php`
-   Rédacteurs: `author.php` (avec l'extension co-authors plus)
-   Erreur 404: `404.php`
-   Page pour l'équipe : `team.php`

**STYLES**

Le style du site est construit avec sass. Tous les fichiers de base se trouvent dans `scss/` et sont compilés vers `main.css`. Pour compiler le style, faites comme ceci:

1) `npm install` ou `yarn install`
2) `npm run css` ou `yarn css`
3) Pour développer: `npm run serve` ou `yarn serve`, les mises à jour du style se feront en __real time__ 


**fonctions**

-   `functions.php` : si on veut ajouter des menus
-   `inc/customizer.php` : pour ajouter des champs dans l'onglet de
    personnalisation admin
-   `js/customizer.js` : pour mettre à jour le **customizer** en temps
    réel
-   `inc/template-functions.php` : pour les fonctionalités admin en plus
    et l'api rest
-   `inc/template-tags.php` : référence pour des balises genre
    `topolitik_posted_on()` pour afficher la date de l'article

**SEARCH**

Le moteur de recherche du site est construit en React.js. Pour modifier le code, il suffit de taper `npm run search` ou `yarn search`.

-------

## TODO:

-   Inclure des PDF ou 'carousel' pour certains articles (blocks ?)
-   Base pour scss, le résultat se trouvant sur "style.css" ✌️
-   Mettre à jour la page de co-auteur ✍️
-   Rendre les pages de catégories plus 'solides' (quand les articles s'ajoutent) ✍️


✍️ = entrain de bosser dessus
✌️ = pas mal
👌 = top

-------
## Communication

- TODO: Truc à faire
- COMMENT: Réflexion dans le code
- @Nom-de-la-personne-à-interpeller
- FIXME: Bug à corriger
