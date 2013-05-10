<?php
$result = $this->Categorie->getTreeList();
echo $this->helpers['Form']->input('parent_id', 'Catégorie parente',array('type' => 'selectList', 'datas' => $result));
echo $this->helpers['Form']->input('name', 'Titre de la page',array('class' => 'input-block-level'));
echo $this->helpers['Form']->input('slug', 'Url',array('class' => 'input-block-level'));
echo $this->helpers['Form']->input('content', 'Contenu', array('type' => 'textarea','class'=>'text-input textarea', 'rows' => 10, 'cols' => 75));
echo $this->helpers['Form']->ckeditor(array('content'));
echo $this->helpers['Form']->input('online', 'En ligne', array('type' => 'checkbox')); echo "<br />";