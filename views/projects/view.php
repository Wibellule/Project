<?php
$title_for_layout = $project['name'];
$description_for_layout = $project['name'];

$var_p = array();
$var_p = $project['content'];
$var_p = explode('/>',$project['content']);
$var_p = array_slice($var_p, 0, -1);
// var_dump($var_p);

?>
<article class="single-project">

	<header class="page-header">

		<h1 class="page-title align-left">Things we have done</h1>
		
		<a href="<?php echo Router::url('portefolio');?>" class="button no-bg medium align-right">
			Portefolio <img src="<?php echo Router::webroot('img/icon-grid.png');?>" alt="" class="icon">
		</a>

		<hr />

		<h2 class="project-title">Single Project / <?php echo $project['name'];?></h2>

		<ul class="portfolio-pagination">
			<li class="prev"><a href="#" class="button medium no-bg"><span class="arrow left">&raquo;</span> Previous</a></li>
			<li class="next"><a href="#" class="button medium no-bg">Next <span class="arrow">&raquo;</span></a></li>
		</ul><!-- end .portfolio-pagination -->
		
	</header><!-- end .page-header -->

	<div id="main">
	
		<div class="image-gallery-slider">

			<ul>
				<?php foreach($var_p as $k => $v){?>
				<li>
					<?php $link = explode('<img alt="" src="', $v); $link = implode('',$link); $link = substr($link, 0, strpos($link, '" '));?>
					<a href="<?php echo $link;?>" class="single-image" title="<?php echo $project['name'];?>" rel="single-project">
						<?php echo $v.'/>';?>
					</a>
				</li>
				<?php } ?>
			</ul>
			
		</div><!-- end .image-gallery-slider -->
	
	</div><!-- end #main -->

	<div id="sidebar">

		<h4>Description</h4>

		<p><?php echo $project['description'];?></p>

	</div><!-- end #sidebar -->
	
</article><!-- end .single-project -->

