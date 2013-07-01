<?php

echo $this->helpers['Form']->input('name', 'Nom',array('class' => 'input-block-level'));
echo $this->helpers['Form']->input('email', 'Email',array('class' => 'input-block-level'));
echo $this->helpers['Form']->input('url', 'Site Web',array('class' => 'input-block-level'));
echo $this->helpers['Form']->input('message', 'Contenu', array('type' => 'textarea','class'=>'text-input textarea', 'rows' => 10, 'cols' => 75));
echo $this->helpers['Form']->ckeditor(array('message'));
echo $this->helpers['Form']->input('online', 'En ligne', array('type' => 'checkbox')); echo "<br />";
echo $this->helpers['Form']->input('post_id', 'Article n°',array('class' => 'input-block-level'));