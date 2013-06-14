<?php
$title_for_layout = $categories['name'];
$description_for_layout = strip_tags($page['content']);
?>
<div class="hero-unit">
	<h1><?php echo $page['name'];?></h1>
	<?php
		echo '<pre>';
		print_r($page);
		echo '</pre>';
	?>
	<?php
		echo $page['content'];
	
	?>
</div>