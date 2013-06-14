<div>
	<?php
		$messageFlash = Session::read('Flash');
		if($messageFlash){
			echo "<div class='alert alert-".Session::read('Flash.type')."'>";
			echo Session::read('Flash.message').'</div>';
		}
		Session::delete('Flash');
		prTab($formulaire);
	?>
</div>