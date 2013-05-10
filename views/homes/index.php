<section id="features-slider" class="ss-slider">

<h2 class="slogan align-center">We are a group of experienced designers and developers.<br />
	We set new standards in user experience &amp; make future happen.</h2>
	
<?php 
	foreach($sliders as $k => $v){
		echo $v['image'];
	} 
?>

</section>

<h6 class="section-title">Derniers projets</h6>

<ul class="projects-carousel clearfix">

<?php foreach($projects as $k => $v){?>

	<li>
	
		<a href="<?php echo Router::url('projects/view/id:'.$v['id'].'/slug:'.$v['slug'].'/prefix:portefolio', 'projects');?>">
		
			<?php echo $v['thumbnail'];?>
			
			<h5 class="title"><?php echo $v['name'];?></h5>
			
			<span class="categories"><?php echo $v['type'];?></span>
			
		</a>
		
	</li>
	
<?php } ?>

</ul><!-- end .projects-carousel -->

<h6 class="section-title">Derniers articles</h6>

	<ul class="post-carousel">
	
		<?php 
			foreach($posts as $k => $v){ 
				switch($v['tag']){
		
					case $v['tag']: 
			
						include(FRONTOFFICE.DS.'post_home'.DS.lcfirst($v['tag']).'.php');
				
					break;
			
				} 
			} 
		?>
	</ul><!-- end .post-carousel -->