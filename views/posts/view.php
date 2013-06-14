<?php
$title_for_layout = $post['name'];
$description_for_layout = $post['name'];
?>


<header class="page-header">

	<h1 class="page-title"><?php echo $post['name'];?></h1>	
	
</header><!-- end .page-header -->

<section id="main">

	<?php 
	switch($post['tag']){ 
	
		case $post['tag']:
		
			include(FRONTOFFICE.DS.'post_view'.DS.lcfirst($post['tag']).'.php');
			
		break; 
	
	} 
	?>
	
</section>

<?php include(FRONTOFFICE.DS.'post'.DS.'menu_blog.php');?>