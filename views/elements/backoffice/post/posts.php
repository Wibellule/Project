<?php
$type = '';
foreach($typeposts['typeposts'] as $k => $v){
	$type .= $v['name'].",";
}
$result = (substr($type,0,-1));
$result = explode(',',$result);
echo $this->helpers['Form']->input('name', 'Titre de l\'article',array('class' => 'input-block-level'));
echo $this->helpers['Form']->input('slug', 'Url',array('class' => 'input-block-level'));
echo $this->helpers['Form']->input('image', 'Image en-tête', array('type' => 'textarea','class'=>'text-input textarea', 'rows' => 10, 'cols' => 75));
echo $this->helpers['Form']->input('short_content', 'Description courte', array('type' => 'textarea','class'=>'text-input textarea', 'rows' => 10, 'cols' => 75));
echo $this->helpers['Form']->input('content', 'Contenu', array('type' => 'textarea','class'=>'text-input textarea', 'rows' => 10, 'cols' => 75));
echo $this->helpers['Form']->ckeditor(array('image','short_content','content'));
echo $this->helpers['Form']->input('tag', 'Type d\'article', array('type' => 'select','datas' => $result));
echo $this->helpers['Form']->input('display_option', 'Formulaire de contact', array('type' => 'selectList', 'datas' => array( 0 => 'Pas d\'options', 1 => 'Formulaire de commentaires')));echo "<br />";
echo $this->helpers['Form']->input('online', 'En ligne', array('type' => 'checkbox')); echo "<br />";