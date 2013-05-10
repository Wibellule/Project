<?php
echo $this->helpers['Form']->input('name', 'Titre du slider');
echo $this->helpers['Form']->input('image', 'Image du slider', array('type' => 'textarea', 'rows' => 10, 'cols' => 75));
echo $this->helpers['Form']->input('content', 'Contenu', array('type' => 'textarea', 'rows' => 10, 'cols' => 75));
echo $this->helpers['Form']->ckeditor(array('image','content'));
echo $this->helpers['Form']->input('online', 'En ligne', array('type' => 'checkbox')); echo "<br />";