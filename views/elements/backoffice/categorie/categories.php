<?php
$result = $this->Categorie->getTreeList();
$redirect = $this->Categorie->getTreeList();
$redirect[0] = 'Pas de redirection';
$redirect[-1] = "[&nbsp;&nbsp;&nbsp;Page d'accueil&nbsp;&nbsp;&nbsp;]";
$redirect[-2] = "[&nbsp;&nbsp;&nbsp;Blog&nbsp;&nbsp;&nbsp;]";
$redirect[-3] = "[&nbsp;&nbsp;&nbsp;Galerie&nbsp;&nbsp;&nbsp;]";
// pr($redirect);
echo $this->helpers['Form']->input('parent_id', 'Catégorie parente',array('type' => 'selectList', 'datas' => $result));
echo $this->helpers['Form']->input('name', 'Titre de la page',array('class' => 'input-block-level'));
echo $this->helpers['Form']->input('slug', 'Url',array('class' => 'input-block-level'));
echo $this->helpers['Form']->input('content', 'Contenu', array('type' => 'textarea','class'=>'text-input textarea', 'rows' => 10, 'cols' => 75));
echo $this->helpers['Form']->ckeditor(array('content'));
echo $this->helpers['Form']->input('redirection_category_id', 'Redirection', array('type' => 'selectList', 'datas' => $redirect )); echo "<br />";
echo $this->helpers['Form']->input('online', 'En ligne', array('type' => 'checkbox')); echo "<br />";