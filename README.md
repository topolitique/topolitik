![topo](screenshot.png)

<h1 style="text-align:center">
Design for [topolitique.ch](http://topolitique.ch)
</h1>
<p style="text-align:center">
Wordpress theme with specific news features. Using Coauthors Plus and
Parsedown. </p>

## Structure :

**éléments d'une page**

-   En-tête : `header.php`
-   Bas de page : `footer.php`
-   Commentaires : `comments.php`
-   Contenu de l'article : `content.php`
-   **Lien à l'article (avec abstract)** : `post-card.php`
-   **Lien à l'article (sans abstract)** : `post-card-small.php`

**pages complètes**

-   Index: `topoindex.php` articles par section, on peut ajouter ou
    enlever des sections...
-   Derniers articles: `index.php` (index par défaut, replacé par
    topoindex.php) -> '/latest'
-   Catégorie:  `archive.php` : '/category/\<...>'
-   Article: `single.php`
-   Rédacteurs: `author.php` (avec l'extension co-authors plus)
-   Erreur 404: `404.php`
-   Page spéciale : `page.php`
-   Page pour l'équipe : `team.php`

**styles**

-   Site: `style.css`
-   Impression: `print.css`

**fonctions**

-   `functions.php` : si on veut ajouter des menus (pour l'instant:
    Primary=catégories, Secondary=autres liens)
-   `inc/customizer.php` : pour ajouter des champs dans l'onglet de
    personnalisation admin
-   `js/customizer.js` : pour mettre à jour le **customizer** en temps
    réel
-   `inc/template-functions.php` : pas utilisé
-   `inc/template-tags.php` : référence pour des balises genre
    `topolitik_posted_on()` pour afficher la date de l'article

## TODO:

-   place pour une bannière spéciale ✌️
-   enlever les commentaires ✌️ (on peut les désactiver sur admin?)
-   trouver un moyen d'afficher des liens event et topotv
-   Inclure des PDF ou 'carousel' pour certains articles

✍️ = entrain de bosser dessus
✌️ = pas mal
👌 = top
