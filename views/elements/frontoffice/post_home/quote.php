<li>

	<div class="entry-meta">

		<a href="<?php echo Router::url('posts/view/id:'.$v['id'].'/slug:'.$v['slug'].'/prefix:article');?>">
			<span class="post-format quote">Permalink</span>
		</a>

		<span class="date"><?php echo $v['created'];?></span>

	</div><!-- end .entry-meta -->

	<div class="entry-body">
		
		<?php echo substr($v['image'],0,75).'...';?>
			
	</div><!-- end .entry-body -->

</li>