<?php
	$titrepage = array(
		'posts' => 'article',
		'categories' => 'page',
		'sliders' => 'slider',
		'projects' => 'project',
		'typeprojects' => 'type de projet',
		'typeposts' => 'type d\'article'
	);
	
	// echo $titrepage[$this->request->controller];
	$messageFlash = Session::read('Flash');
		if($messageFlash){
			echo "<p class=".Session::read('Flash.type')."'>";
			echo Session::read('Flash.message').'</p>';
		}
	Session::delete('Flash');
?>