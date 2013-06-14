<?php
$title_for_layout = $categorie['name'];
$description_for_layout = strip_tags($categorie['content']);
?>
<div class="hero-unit">
	<h2><?php echo $categorie['name'];?></h2>
	<?php
		echo $categorie['content'];
	?>
	</br>
	<?php 
		if($categorie['display_option'] == 1){ 
			echo $this->helpers['Html']->contact($categorie['id'],$categorie['slug']);
			// echo $this->element(FRONTOFFICE.DS.'js'.DS.'ajax_formulaire.php');
		} 
	?>
</div>


