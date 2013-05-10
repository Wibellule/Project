<header class="page-header">
	
		<h1 class="page-title">Mes projets</h1>

		<ul id="portfolio-items-filter">

			<li>Filtre</li>
			<li><a data-categories="*">Tous</a></li>
			
			<?php foreach($type as $k => $v){ ?>
			
				<li><a data-categories="<?php echo $v['name'];?>"><?php echo ucfirst($v['name']);?></a></li>
			
			<?php } ?>

		</ul><!-- end #portfolio-items-filter -->
		
	</header><!-- end .page-header -->
	
<?php $controllerData = $this->request->controller; //pr($controllerData);?>

<section id="portfolio-items" class="clearfix">

	<?php for($i = 0;$i < $nbProjects; $i++){ ?>
	
		<article class="one-fourth" data-categories="<?php prTab($projects['project'][$i]['type']);?>">
		
			<a class="single-image" href="<?php prTab($link[$i][0]);?>" title="">
			
				<?php prTab($projects['project'][$i]['thumbnail']);?>
				
			</a>
			
			<a href="<?php echo Router::url($controllerData.'/view/id:'.$projects['project'][$i]['id'].'/slug:'.$projects['project'][$i]['slug'].'/prefix:portefolio', $this->request->controller);?>" class="project-meta">
				
				<h5 class="title"><?php prTab($projects['project'][$i]['name']);?></h5>
				
				<span class="categories"><?php prTab($projects['project'][$i]['type']);?></span>
			
			</a>
		
		</article>
	
	<?php } ?>
</section>