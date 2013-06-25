<?php
function module_enabled($name) {
    return function_exists('apache_get_modules') && in_array($name, apache_get_modules());
}

function is_active($name){
	if(module_enabled($name)){
		$return = '<div class="alert alert-success"><i class="icon-ok"></i>&nbsp;Le module <strong>'.$name.'</strong> est activé</div>';
	}else{
		$return = '<div class="alert alert-error"><i class="icon-remove"></i>&nbsp;Le module <strong>'.$name.'</strong> est désactivé</div>';
	}
	return $return;
}