<?php
Router::prefix('adm','backoffice');//Définition du prefixe backoffice

// - a gauche l'url voulue
// - a droite l'url renseigné dans les vues

//////////////////////
//REGLES FRONTOFFICE//

// Router::connect('install');

//Accueil
Router::connect('','homes/index');
Router::connect('adm','adm/posts/index');

//Détails d'un article + listing
Router::connect(':prefix/:slug-:id', 'posts/view/id:([0-9]+)/slug:([a-z0-9\-]+)/prefix:([a-z0-9\-]+)');

//Détails d'un project
Router::connect(':prefix/:slug-:id', 'projects/view/id:([0-9]+)/slug:([a-z0-9\-]+)/prefix:([a-z0-9\-]+)');
// Router::connect(':slug-:id', 'projects/view/id:([0-9]+)/slug:([a-z0-9\-]+)');

//Blog
Router::connect('blog','posts/index');

Router::connect('standard','posts/index/standard');
Router::connect('galerie','posts/index/gallery');
Router::connect('video','posts/index/video');
Router::connect('lien','posts/index/link');
Router::connect('citation','posts/index/quote');
Router::connect('aside','posts/index/aside');
Router::connect('audio','posts/index/audio');

//Portefolio
Router::connect('portefolio','projects/index');

//Liste de toutes les pages
Router::connect(':slug-:id','categories/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect('ajout_page','adm/categories/add');

//Admin
Router::connect('admin','adm/index');//Vers admin
Router::connect('adminblog','adm/posts/index');//Vers l'admin posts index
Router::connect('ajout_article','adm/posts/add/');//Vers ajout d'articles
Router::connect('editer_article','adm/posts/edit/');//Vers édition articles

//Connexion
Router::connect('connexion','users/login');