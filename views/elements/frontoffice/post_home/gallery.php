<li>
	<div class="image-gallery-slider">
		<ul>
			<?php 
				$var_g = $v['image'];
				$var_g = explode('/>', $var_g);
				$var_g = array_slice($var_g, 0, -1);
				// var_dump($var_g);
			?>
			<?php foreach($var_g as $k => $var){ ?>
			<li>
				<a href="<?php echo Router::url('posts/view/id:'.$v['id'].'/slug:'.$v['slug'].'/prefix:article');?>">
					<?php echo $var.'/>';?>
				</a>
			</li>
			<?php } ?>
		</ul>
		
	</div><!-- end .image-gallery-slider -->

	<div class="entry-meta">

		<a href="<?php echo Router::url('posts/view/id:'.$v['id'].'/slug:'.$v['slug'].'/prefix:article');?>">
			<span class="post-format gallery">Permalink</span>
		</a>

		<span class="date"><?php echo $v['created'];?></span>

	</div><!-- end .entry-meta -->

	<div class="entry-body">

		<a href="<?php echo Router::url('posts/view/id:'.$v['id'].'/slug:'.$v['slug'].'/prefix:article');?>">
			<h5 class="title"><?php echo $v['name'];?></h5>
		</a>

		<?php echo substr($v['short_content'],0,125).'...';?>
			
	</div><!-- end .entry-body -->
	
</li>