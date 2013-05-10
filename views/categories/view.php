<?php
$title_for_layout = $categorie['name'];
$description_for_layout = strip_tags($categorie['content']);
?>
<div class="hero-unit">
	<h2><?php echo $categorie['name'];?></h2>
	<?php
		echo $categorie['content'];
	?>
</div>