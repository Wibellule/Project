<?php	
	$messageFlash = Session::read('Flash');
		if($messageFlash){
			echo "<p class=".Session::read('Flash.type')."'>";
			echo Session::read('Flash.message').'</p>';
		}
	Session::delete('Flash');
?>