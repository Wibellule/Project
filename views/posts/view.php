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
<?php 
	if($post['display_option'] == 1){ 
		echo $this->helpers['Html']->comment($post['id'],$post['slug']);
	} 
?>

<?php include(FRONTOFFICE.DS.'post'.DS.'menu_blog.php');?>