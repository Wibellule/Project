<?php
$type = '';
foreach($typeprojects['typeprojects'] as $k => $v){
	$type .= $v['name'].",";
}
$result = (substr($type,0,-1));
$result = explode(',',$result);
// pr($result);

echo $this->helpers['Form']->input('name', 'Titre du projet');
echo $this->helpers['Form']->input('description', 'Description du projet', array('type' => 'textarea', 'rows' => 10, 'cols' => 75));
echo $this->helpers['Form']->input('slug', 'Url');
echo $this->helpers['Form']->input('thumbnail', 'Miniature', array('type' => 'textarea', 'rows' => 10, 'cols' => 75));
echo $this->helpers['Form']->input('content', 'Contenu', array('type' => 'textarea', 'rows' => 10, 'cols' => 75));
echo $this->helpers['Form']->ckeditor(array('description','thumbnail','content'));
echo $this->helpers['Form']->input('type', 'Type de projet', array('type' => 'select','datas' => $result));
echo $this->helpers['Form']->input('online', 'En ligne', array('type' => 'checkbox')); echo "<br />";

