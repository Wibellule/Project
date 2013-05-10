<aside id="sidebar">

	<div class="widget">

		<h6 class="widget-title">Blog Categories</h6>

		<ul class="categories">
		
			<?php foreach($typeposts as $k => $v){ ?>
			
			<li><a href="<?php echo Router::url('posts/index/'.lcfirst($v['name'])); ?>"><?php echo $v['name'];?></a></li>
			
			<?php } ?>
			
			<li><a href="<?php echo Router::url('blog'); ?>">Tous les articles</a><li>
			
		</ul>

	</div><!-- end .widget -->
	
</aside><!-- end #sidebar -->